<?php
include ('../funtion/myfunction.php'); 

if(isset($_SESSION['auth']))
{
    if($_SESSION['verify_status'] != 1)
    {
        redirect("../index.php","คุณไม่ได้รับอนุญาตให้เข้าถึงหน้านี้ กรุณายืนยันตัวตนในอีเมล์ของท่าน");
    }
}
else
{
    redirect("../login.php","เข้าสู่ระบบเพื่อดำเนินการต่อ");
}

?>