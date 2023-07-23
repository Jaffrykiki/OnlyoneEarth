<?php 
session_start();
include('../connection/dbcon.php');

if(isset($_GET['token']))
{
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status FROM users WHERE verify_token='$token' LIMIT 1";
    $verify_query_run = mysqli_query($connection, $verify_query);

    if(mysqli_num_rows($verify_query_run) > 0 )
    {
        $row = mysqli_fetch_array($verify_query_run);
        if($row['verify_status'] == "0")
        {
            $click_token  = $row['verify_token'];
            $update_qurty = "UPDATE users SET verify_status = '1' WHERE verify_token='$click_token' LIMIT 1  ";
            $update_qurty_run = mysqli_query($connection, $update_qurty);

            if($update_qurty_run)
            {
                $_SESSION['message'] = "บัญชีของคุณได้รับการยืนยันเรียบร้อยแล้ว";
                header("Location: ../login.php");
                exit(0);
            }
            else
            {
                $_SESSION['message'] = "การตรวจสอบล้มเหลว";
                header("Location: ../login.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['message'] = "ยืนยันอีเมลแล้ว กรุณาเข้าสู่ระบบ";
            header("Location: ../login.php");
            exit(0);
        }
    
    }
    else
    {
        $_SESSION['message'] = "ไม่มีโทเค็นนี้";
        header("Location: ../login.php");
    }
}
else
{
    $_SESSION['message'] = "ไม่ได้รับอนุญาต";
    header("Location: ..login.php");
}



?>
