<?php 

// เชื่อมต่อกับฐานข้อมูล MySQL โดยใช้ข้อมูลการเชื่อมต่อดังกล่าว
$connection = mysqli_connect("localhost","root","","onlyoneearth");

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if (!$connection) {
    // หากการเชื่อมต่อล้มเหลว จะแสดงข้อความแสดงสาเหตุของข้อผิดพลาด
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// หากการเชื่อมต่อล้มเหลว จะแสดงข้อความแสดงสาเหตุของข้อผิดพลาด  


?>