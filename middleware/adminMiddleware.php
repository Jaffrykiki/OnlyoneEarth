<?php
include ('../funtion/myfuntion.php'); 

if(isset($_SESSION['auth']))
{
    if($_SESSION['role_as'] != 1)
    {
        redirect("../index.php","คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้");
    }
}
else
{
    redirect("../login.php","เข้าสู่ระบบเพื่อดำเนินการต่อ");
}

?>