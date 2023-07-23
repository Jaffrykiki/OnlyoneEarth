<?php
include ('../funtion/myfuntion.php'); 

if(!isset($_SESSION['authenticated']))
{
    $_SESSION['message'] = 'โปรดเข้าสู่ระบบก่อน';
    {
        redirect("../login.php","คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้");
    }
}

?>