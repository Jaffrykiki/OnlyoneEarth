<?php 

//ตรวจสอบสิทธิ์
if(!isset($_SESSION['auth']))
{
     redirect("login.php",'เข้าสู่ระบบเพื่อดำเนินการต่อ');
}

?>