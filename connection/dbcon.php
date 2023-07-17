<?php 

$connection = mysqli_connect("localhost","root","","onlyoneearth");

if (!$connection) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}


?>