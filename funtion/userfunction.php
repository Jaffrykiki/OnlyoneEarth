<?php

session_start();
include('connection/dbcon.php');

// if (!isset($_SESSION['auth_user'])) {
//     // ไม่มีข้อมูล session auth
//     header("Location:../login.php"); // แก้ไขเป็น URL ของหน้า login ที่คุณต้องการให้ redirect
//     exit(); // จบการทำงานของสคริปต์
// }

// ฟังก์ชันสำหรับการดึงข้อมูลทั้งหมดในตาราง 
function getAllActive($table)
{
    global $connection;
    $query = "SELECT * FROM `$table` ";
    return $query_run = mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับการดึงรายการสินค้าที่กำลังมาแรง
function getAllTrending()
{
    global $connection;
    $query = "SELECT * FROM products WHERE trending= '1' ";
    return $query_run = mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับการดึงรายการสินค้าทั้งหมด
function getAllProducts()
{
    global $connection;
    $query = "SELECT * FROM products LIMIT 8 ";
    return mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับการค้นหาข้อมูลโดยชื่อในตาราง
function getNameActive($table, $name)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE  name ='$name' "; // สร้างคำสั่ง SQL เพื่อค้นหาข้อมูลที่ตรงกับชื่อที่ระบุ
    return $query_run = mysqli_query($connection, $query); // ส่งคำสั่ง SQL ไปประมวลผลที่ฐานข้อมูล

}

// ฟังก์ชันสำหรับการค้นหาสินค้าตามหมวดหมู่
function getProdByCategory($category_id)
{
    global $connection;
    $query = "SELECT * FROM products WHERE category_id= '$category_id'  ";
    return $query_run = mysqli_query($connection, $query);
}

function getIDActive($table, $id)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE  id ='$id' ";
    return $query_run = mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับแสดงรายการสินค้าในตระกร้า
function getCartItems()
{
    global $connection;
    $userId = $_SESSION['auth_user']['id'];

    $query = "SELECT 
    c.id AS cid, 
    c.prod_id, 
    c.prod_qty, 
    p.id AS pid, 
    p.name, 
    p.price, 
    pi.image_filename
FROM 
    carts c
JOIN 
    products p ON c.prod_id = p.id
LEFT JOIN 
    (
        SELECT product_id, MIN(image_filename) AS image_filename
        FROM product_images
        GROUP BY product_id
    ) pi ON p.id = pi.product_id
WHERE 
    c.user_id = '$userId'
ORDER BY 
    c.id DESC
";
    return $query_run = mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับแสดงรายการออเดอร์
function getOrders()
{
    global $connection;
    $userId = $_SESSION['auth_user']['id'];
    $query = "SELECT * FROM orders WHERE user_id='$userId'";
    return $query_run = mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับการเก็บข้อความและเปลี่ยนเส้นทางการเรียกหน้า
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}

// ฟังก์ชันสำหรับตรวจสอบความถูกต้องของหมายเลขติดตาม
function checkTrackingNoValid($trackingNo)
{
    global $connection;
    $userId = $_SESSION['auth_user']['id'];

    $query  = "SELECT * FROM orders WHERE tracking_no='$trackingNo' AND user_id='$userId' ";
    return  mysqli_query($connection, $query);
}
// ฟังก์ชันสำหรับค้นหาหมวดหมู่
function searchCategories($searchTerm)
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM category WHERE name LIKE '%$searchTerm%'"; // ค้นหาข้อมูลหมวดหมู่
    $result = mysqli_query($connection, $query);

    $category = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $category[] = $row;
    }
    return $category;
}

// ฟังก์ชันสำหรับค้นหาสินค้า
function searchProducts($searchTerm)
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM products WHERE name LIKE '%$searchTerm%'"; // ค้นหาข้อมูลสินค้า
    $result = mysqli_query($connection, $query);

    $product = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }
    return $product;
}


// ฟังก์ชันสำหรับแสดงข้อมูลผู้ใช้
function getUsers()
{
    global $connection;
    $userId = $_SESSION['auth_user']['id'];
    $query = "SELECT * FROM users WHERE id ='$userId'";
    return $query_run = mysqli_query($connection, $query);
}
