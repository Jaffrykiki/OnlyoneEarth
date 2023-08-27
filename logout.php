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

// เคลียร์ข้อมูลทั้งหมดในเซสชัน
$_SESSION = array();

// หากต้องการทำลายเซสชัน เรายังต้องลบคุกกี้ของเซสชันด้วย
// หมายเหตุ: การทำนี้จะทำลายเซสชันทั้งหมด ไม่ได้เพียงแค่เฉพาะข้อมูลในเซสชัน!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// สุดท้ายนี้เราจะทำลายเซสชัน
session_destroy();
// ส่ง header เพื่อเปลี่ยนเส้นทางไปยังหน้า login.php หลังจากทำการล็อกเอาท์สำเร็จ
header("Location: login.php");
exit;

?>