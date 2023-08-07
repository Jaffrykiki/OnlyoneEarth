<?php 
session_start();
include('../connection/dbcon.php');

//เพิ่่ม //เรียกดูสินค้า
function getAll($table, $where = false)
{  
    $query = "";
    if ($where) {
        $users_id = $_SESSION['auth_user']['id'];
        $query = "SELECT * FROM $table WHERE users_id = $users_id";    
    } else {
        $query = "SELECT * FROM $table";
    }
    
    global $connection;
    
    return $query_run = mysqli_query($connection, $query);
}

//แก้ไข
function getByID($table, $id)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE  id ='$id' ";
    return $query_run = mysqli_query($connection, $query);

}

//ข้อความ

function redirect($url, $message) 
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}

//ดูคำสั่งซื้อที่สถานะยังไม่ดำเนินการ
function getAllOrders()
{  
    global $connection;
    $query = "SELECT * FROM orders  WHERE status='0'";
    return $query_run = mysqli_query($connection, $query);
}
//ดูคำสั่งซื้อที่สำเร็จแล้ว
function getOrderHistroy()
{  
    global $connection;
    $query = "SELECT * FROM orders  WHERE status !='0'";
    return $query_run = mysqli_query($connection, $query);
}

//เช็คว่ามีเลขพัสดุหรือไม่
function checkTrackingNoValid($trackingNo)
{
    global $connection;
    $query  = "SELECT * FROM orders WHERE tracking_no='$trackingNo'";
    return  mysqli_query($connection, $query);
}







?>