<?php 
session_start();
include('../connection/dbcon.php');


// ตรวจสอบว่ามีการส่งค่า 'token' ผ่าน URL
if(isset($_GET['token']))
{
    $token = $_GET['token']; // รับค่า 'token' จาก URL
    // สร้างคำสั่ง SQL สำหรับการตรวจสอบสถานะการยืนยันของโทเค็น
    $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($connection, $verify_query);

    // ตรวจสอบว่ามีข้อมูลในการยืนยันโทเค็นหรือไม่
    if(mysqli_num_rows($verify_query_run) > 0 )
    {
      
        $row = mysqli_fetch_array($verify_query_run);  // ดึงข้อมูลจากแถวที่พบ   
        if($row['verify_status'] == "0") // ตรวจสอบสถานะการยืนยัน
        {
            // ดึงโทเค็นที่ถูกคลิกเพื่อใช้ในการอัปเดตสถานะการยืนยัน
            $click_token  = $row['verify_token'];   
            // สร้างคำสั่ง SQL สำหรับการอัปเดตสถานะการยืนยัน
            $update_qurty = "UPDATE users SET verify_status = '1' WHERE verify_token='$click_token' LIMIT 1  ";
            $update_qurty_run = mysqli_query($connection, $update_qurty);

            // ตรวจสอบการอัปเดตสถานะและดำเนินการต่อไป
            if($update_qurty_run)
            {
                // เมื่ออัปเดตสถานะสำเร็จ
                $_SESSION['message'] = "บัญชีของคุณได้รับการยืนยันเรียบร้อยแล้ว";
                header("Location: ../login.php");
                exit(0);
            }
            else
            {
                // เมื่อการอัปเดตสถานะล้มเหลว
                $_SESSION['message'] = "การตรวจสอบล้มเหลว";
                header("Location: ../login.php");
                exit(0);
            }
        }
        else
        {
            // เมื่อโทเค็นได้รับการยืนยันแล้ว
            $_SESSION['message'] = "ยืนยันอีเมลแล้ว กรุณาเข้าสู่ระบบ";
            header("Location: ../login.php");
            exit(0);
        }
    
    }
    else
    {
        // เมื่อไม่พบโทเค็นที่ระบุในฐานข้อมูล
        $_SESSION['message'] = "ไม่มีโทเค็นนี้";
        header("Location: ../login.php");
    }
}
else
{
    // เมื่อไม่ได้รับค่า 'token' ผ่าน URL
    $_SESSION['message'] = "ไม่ได้รับอนุญาต";
    header("Location: ..login.php");
}

?>
