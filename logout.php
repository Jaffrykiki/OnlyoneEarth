<?php 
session_start();

// ตรวจสอบว่ามีเซสชันที่เก็บข้อมูลการเข้าสู่ระบบหรือไม่
if(isset($_SESSION['auth']))
{
    unset($_SESSION['auth']); // เคลียร์ค่าสถานะการเข้าสู่ระบบ
    unset($_SESSION['auth_user']);  // เคลียร์ข้อมูลผู้ใช้ที่เข้าสู่ระบบ
    unset($_SESSION['login_id']) ;
    $_SESSION['message'] = "ออกจากระบบสำเร็จ";// ตั้งค่าข้อความเซสชันสำหรับแสดงในหน้าที่ผู้ใช้เข้าออกจากระบบ

}
// ส่ง header เพื่อเปลี่ยนเส้นทางไปยังหน้า index.php หลังจากทำการล็อกเอาท์สำเร็จ
header('Location: index.php');

// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
header("Location: login.php");
exit;


?>