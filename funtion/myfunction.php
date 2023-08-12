<?php 
session_start();
include('../connection/dbcon.php');

// เรียกดูข้อมูลสินค้าทั้งหมด โดยสามารถระบุเงื่อนไขการกรองข้อมูลได้
function getAll($table, $where = false)
{  
    $query = "";
    if ($where) {
        $users_id = $_SESSION['auth_user']['id']; // เข้าถึง ID ของผู้ใช้ที่ลงชื่อเข้าใช้
        $query = "SELECT * FROM $table WHERE users_id = $users_id"; //SQL ที่ต้องการดึงข้อมูล     
    } else {
        $query = "SELECT * FROM $table"; 
    }
    
    global $connection; // เรียกใช้ตัวแปรเชื่อมต่อฐานข้อมูล
    
    return $query_run = mysqli_query($connection, $query); //SQL และคืนผลลัพธ์
}

// เรียกดูข้อมูลที่มี ID ตามที่ระบุ
function getByID($table, $id)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE  id ='$id' "; // SQL ที่ใช้ดึงข้อมูลจาก ID ที่กำหนด
    return $query_run = mysqli_query($connection, $query);

}

// ฟังก์ชันสำหรับการเปลี่ยนเส้นทาง (Redirect) พร้อมแสดงข้อความ
function redirect($url, $message) 
{
    $_SESSION['message'] = $message; // เก็บข้อความในเซสชันเพื่อแสดงในหน้าที่ถูกเปลี่ยนเส้นทาง
    header('Location: '.$url); // เปลี่ยนเส้นทางไปยัง URL ที่กำหนด
    exit(); // ออกจากสคริปต์
}

// ดึงคำสั่งซื้อที่มีสถานะ "0" (ยังไม่ดำเนินการ)
function getAllOrders()
{  
    global $connection;
    $query = "SELECT * FROM orders  WHERE status='0'"; //SQL สำหรับการดึงคำสั่งซื้อที่สถานะ "0"
    return $query_run = mysqli_query($connection, $query);
}

// ดึงคำสั่งซื้อที่ไม่มีสถานะ "0" (สำเร็จแล้ว)
function getOrderHistroy()
{  
    global $connection;
    $query = "SELECT * FROM orders  WHERE status !='0'"; // สร้างคำสั่ง SQL สำหรับการดึงคำสั่งซื้อที่ไม่มีสถานะ "0"
    return $query_run = mysqli_query($connection, $query);
}

// เช็คว่าเลขพัสดุถูกต้องหรือไม่
function checkTrackingNoValid($trackingNo)
{
    global $connection;
    $query  = "SELECT * FROM orders WHERE tracking_no='$trackingNo'"; // SQL สำหรับการตรวจสอบเลขพัสดุ
    return  mysqli_query($connection, $query);
}

// ค้นหาผู้ใช้งานโดยค้นหาจาก ID, ชื่อ, อีเมล์, และเบอร์โทรศัพท์
function searchUsers($searchTerm) {
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM users WHERE 
              id LIKE '%$searchTerm%' OR
              name LIKE '%$searchTerm%' OR 
              email LIKE '%$searchTerm%' OR 
              phone LIKE '%$searchTerm%'"; // SQL สำหรับการค้นหาผู้ใช้งาน
    $result = mysqli_query($connection, $query);
    
    $user = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $user[] = $row; // เก็บข้อมูลผู้ใช้ที่ค้นหาได้ในตัวแปร $user
    }
    return $user; // เก็บข้อมูลผู้ใช้ที่ค้นหาได้ในตัวแปร $user
    
}
