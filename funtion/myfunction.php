<?php
session_start();
include('../connection/dbcon.php');



// เรียกดูข้อมูลสินค้าทั้งหมด
function getAll_product()
{
    global $connection; // เรียกใช้ตัวแปรเชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM products";
    return $query_run = mysqli_query($connection, $query); //SQL และคืนผลลัพธ์
}
//เรียกดูหมวดหมู่สินค้าทั้งหมด
function getAll_category()
{
    global $connection; // เรียกใช้ตัวแปรเชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM category";
    return $query_run = mysqli_query($connection, $query); //SQL และคืนผลลัพธ์
}
//เรียกดูหมวดหมู่สินค้าทั้งหมด
function getAll_user()
{
    global $connection; // เรียกใช้ตัวแปรเชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM users";
    return $query_run = mysqli_query($connection, $query); //SQL และคืนผลลัพธ์
}



// เรียกดูข้อมูลสินค้าทั้งหมดของผู้ขาย
function getAll_product_seller($sellerId)
{
    global $connection; // เรียกใช้ตัวแปรเชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM products WHERE users_id = '$sellerId'";
    return $query_run = mysqli_query($connection, $query); //SQL และคืนผลลัพธ์
}


// เรียกดูข้อมูลที่มี ID ตามที่ระบุ
function getByID($table, $id)
{
    global $connection;
    $query = "SELECT t.*, pi.image_filename
    FROM $table t
    LEFT JOIN product_images pi ON t.id = pi.product_id
    WHERE t.id = '$id'
    "; // SQL ที่ใช้ดึงข้อมูลจาก ID ที่กำหนด
    return $query_run = mysqli_query($connection, $query);
}

// ฟังก์ชันสำหรับการเปลี่ยนเส้นทาง (Redirect) พร้อมแสดงข้อความ
function redirect($url, $message)
{
    $_SESSION['message'] = $message; // เก็บข้อความในเซสชันเพื่อแสดงในหน้าที่ถูกเปลี่ยนเส้นทาง
    header('Location: ' . $url); // เปลี่ยนเส้นทางไปยัง URL ที่กำหนด
    exit(); // ออกจากสคริปต์
}

// ดึงคำสั่งซื้อที่มีสถานะ "0" (ยังไม่ดำเนินการ)
function getAllOrders()
{
    global $connection;
    $query = "SELECT * FROM orders  WHERE status='0'"; //SQL สำหรับการดึงคำสั่งซื้อที่สถานะ "0"
    return $query_run = mysqli_query($connection, $query);
}

// ดึงคำสั่งซื้อที่มีสถานะ "0" (ยังไม่ดำเนินการ) โดยมีไอดีของผู้ขาย
function getAllOrders_seller($sellerId)
{
    global $connection;
    $query = "SELECT * FROM orders WHERE sellerId = '$sellerId' AND status = '0'";
    return $query_run = mysqli_query($connection, $query);
}

// ดึงคำสั่งซื้อที่มีสถานะ "0" (ยังไม่ดำเนินการ) โดยมีไอดีของผู้ขาย
function getAllproduct_seller($sellerId)
{
    global $connection;
    $query = "SELECT products.*, 
    (SELECT image_filename 
     FROM product_images 
     WHERE product_images.product_id = products.id 
     LIMIT 1) AS image_filename
    FROM products
    WHERE products.users_id = '$sellerId' AND products.num = 0;
    ";
    return $query_run = mysqli_query($connection, $query);
}

// ดึงคำสั่งซื้อที่ไม่มีสถานะ "0" (สำเร็จแล้ว)
function getOrderHistroy()
{
    // ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
    $sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ
    global $connection;
    $query = "SELECT * FROM orders  WHERE status !='0' AND sellerId = '$sellerId'"; // สร้างคำสั่ง SQL สำหรับการดึงคำสั่งซื้อที่ไม่มีสถานะ "0"
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
function searchUsers($searchTerm)
{
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

// ฟังก์ชันสำหรับค้นหาหมวดหมู่
function searchCategories($searchTerm)
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM category WHERE id LIKE '%$searchTerm%' OR name LIKE '%$searchTerm%'"; // ค้นหาข้อมูลหมวดหมู่
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
    $query = "SELECT products.*, product_images.image_filename
    FROM products
    LEFT JOIN (
        SELECT product_id, MIN(image_filename) AS image_filename
        FROM product_images
        GROUP BY product_id
    ) AS product_images ON products.id = product_images.product_id
    WHERE products.name LIKE '%$searchTerm%'
    
    "; // ค้นหาข้อมูลสินค้า
    $result = mysqli_query($connection, $query);

    $product = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }
    return $product;
}

// ฟังก์ชันสำหรับค้นหาสินค้า
function searchProducts_seller($searchTerm)
{
    // ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
    $sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT products.*, product_images.image_filename
    FROM products
    LEFT JOIN (
        SELECT product_id, MIN(image_filename) AS image_filename
        FROM product_images
        GROUP BY product_id
    ) AS product_images ON products.id = product_images.product_id
    WHERE products.name LIKE '%$searchTerm%'
    AND products.users_id = '$sellerId'
    "; // ค้นหาข้อมูลสินค้า
    $result = mysqli_query($connection, $query);

    $product = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }
    return $product;
}

// ฟังก์ชันสำหรับค้นหาออเดอร์
function searchOrders($searchTerm)
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM orders WHERE 
    id LIKE '%$searchTerm%' OR
    name LIKE '%$searchTerm%' OR 
    tracking_no LIKE '%$searchTerm%'";;  // ค้นหาออเดอร์
    $result = mysqli_query($connection, $query);

    $product = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }
    return $product;
}
// ฟังก์ชันสำหรับค้นหาออเดอร์
function searchwithdraw($searchTerm)
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM withdrawals WHERE 
    seller_id LIKE '%$searchTerm%' OR 
    numbank LIKE '%$searchTerm%' OR 
    namebank LIKE '%$searchTerm%' OR 
    name LIKE '%$searchTerm%' OR
    email LIKE '%$searchTerm%'";;  // ค้นหาออเดอร์
    $result = mysqli_query($connection, $query);

    $product = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }
    return $product;
}

//ฟังก์ชันสำหรับค้นหาออเดอร์ที่สำเร็จแล้ว
function searchOrder_history($searchTerm)
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT * FROM orders WHERE   
    id LIKE '%$searchTerm%' OR
    name LIKE '%$searchTerm%'";  // ค้นหาออเดอร์
    $result = mysqli_query($connection, $query);

    $product = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product[] = $row;
    }
    return $product;
}
//ฟังก์ชันสำหรับดึงข้อมูล logs จากตาราง category_logs ในฐานข้อมูล
function getLogs_Cat()
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT `cat_logs_id`, `user_id`, `cat_id`, `event`, `created_at` FROM `category_logs`";  // ค้นหาLogs
  
    // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $query = mysqli_query($connection, $query); 

    // คืนผลลัพธ์การ query กลับไป
    return $query;
 
}
//ฟังก์ชันสำหรับดึงข้อมูล logs จากตาราง product_logs ในฐานข้อมูล
function getLogs_Pro()
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT `p_logs_id`, `u_id`, `p_id`, `event`, `created_at` FROM `products_logs`";  // ค้นหาLogs
  
    // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $query = mysqli_query($connection, $query); 

    // คืนผลลัพธ์การ query กลับไป
    return $query;
 
}
//ฟังก์ชันสำหรับดึงข้อมูล logs จากตาราง users_logs ในฐานข้อมูล
function getLogs_users()
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = " SELECT `u_logs_id`, `a_id`, `u_id`, `event`, `created_at` FROM `users_logs`";  // ค้นหาLogs
    
  
    // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $query = mysqli_query($connection, $query); 

    // คืนผลลัพธ์การ query กลับไป
    return $query;
 
}
//ฟังก์ชันสำหรับดึงข้อมูล logs จากตาราง orders_logsในฐานข้อมูล
function getLogs_Order()
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $query = "SELECT `or_logs_id`, `u_id`, `ord_id`, `event`, `created_at` FROM `orders_logs`";  // ค้นหาLogs
  
    // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $query = mysqli_query($connection, $query); 

    // คืนผลลัพธ์การ query กลับไป
    return $query;
 
}
//ฟังก์ชั่นเรียกดูรายงาน
function getAllReports()
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $select_query = "SELECT * FROM reports";
  
    // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $select_query); 

    // คืนผลลัพธ์การ query กลับไป
    return $select_query;
 
}

//ฟังก์ชั่นเรียกดูรายการถอนเงิน
function getAllwithdraw()
{
    global $connection; // เชื่อมต่อฐานข้อมูล
    $select_query = "SELECT * FROM withdrawals";
  
    // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $select_query); 

    // คืนผลลัพธ์การ query กลับไป
    return $select_query;
 
}

//ฟังก์ชั่นเรียกดูออเดอร์ที่กำลังดำเนินการ
function getOrdersCount() {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE status = 0";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_orders"];
    } else {
        return 0;
    }
}

//ฟังก์ชั่นเรียกดูออเดอร์ที่ดำเนินการแล้ว
function getOrdersComplete() {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE status = 1";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_orders"];
    } else {
        return 0;
    }
}

//ฟังก์ชั่นเรียกดูออเดอร์ที่ยกเลิก
function getOrdersCan() {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE status = 2";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_orders"];
    } else {
        return 0;
    }
}

// ฟังก์ชั่นเรียกดูรายได้ใน orders 
function getTotalPriceWithStatus1() {
    global $connection; // เชื่อมต่อฐานข้อมูล

    $sql = "SELECT SUM(price * qty) AS total FROM order_items ";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}


//ฟังก์ชันสำหรับการคำนวณเปอร์เซ็นต์เพิ่มขึ้น
function calculatePercentageIncrease($previousValue, $currentValue) {
    if ($previousValue === null || $previousValue === 0) {
        return 100; // หากไม่มีค่าก่อนหน้า หรือมีค่าเป็นศูนย์ ให้ถือว่าเพิ่มขึ้น 100%
    }

    return (($currentValue - $previousValue) / $previousValue) * 100;
}


// ฟังก์ชั่นสำหรับดึงข้อมูลผู้ใช้ตามเงื่อนไข role_as = 2 และ verify_status = 1

function getUsersWithCondition() {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_seller FROM users WHERE verify_status = 1 AND role_as = 2 ";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_seller"];
    } else {
        return 0;
    }
}



//ฟังก์ชั่นเรียกดูข้อมูลจากตาราง users โดย role_as = 0 
function getUser() {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_user FROM users WHERE role_as = 0";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_user"];
    } else {
        return 0;
    }
}

//ฟังก์ชั่นเรียกดูสินค้าที่กำลังดำเนินการของผู้ขายสินค้า
function getOrdersCount_seller($sellerId) {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE sellerId = '$sellerId' AND status = 0";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_orders"];
    } else {
        return 0;
    }
}

//ฟังก์ชั่นเรียกดูออเดอร์ที่ดำเนินการแล้วของผู้ขาย
function getOrdersComplete_seller($sellerId) {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE sellerId = '$sellerId' AND status = 1";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_orders"];
    } else {
        return 0;
    }
}

//ฟังก์ชั่นเรียกดูออเดอร์ที่ยกเลิกของผู้ขาย
function getOrdersCan_seller($sellerId) {

    global $connection; // เชื่อมต่อฐานข้อมูล
    $sql = "SELECT COUNT(*) AS total_orders FROM orders WHERE sellerId = '$sellerId' AND status = 2";

     // ทำการ query คำสั่ง SQL ไปยังฐานข้อมูลและรับผลลัพธ์
    $select_query = mysqli_query($connection, $sql); 

    if ($select_query->num_rows > 0) {
        $row = $select_query->fetch_assoc();
        return $row["total_orders"];
    } else {
        return 0;
    }
}

// ฟังก์ชั่นเรียกดูรายได้ใน orders โดยสถานะ = 1 ของผู้ขาย 
function getTotalPriceWithStatus1_seller($sellerId) {
    global $connection; // เชื่อมต่อฐานข้อมูล

    $sql = "SELECT SUM(total_price) AS total FROM orders WHERE sellerId = '$sellerId' AND status = 1";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total'];
    } else {
        return 0;
    }
}
//ฟังก์ชั่นเรียกดู จำนวนเงินที่สามารถถอนได้
function getTotalPriceWithdraw1_seller($sellerId) {
    global $connection; // เชื่อมต่อฐานข้อมูล

    // คำนวณยอดรายได้ทั้งหมดที่มีสถานะเป็น 1
    $sqlTotalIncome = "SELECT SUM(total_price) AS totalIncome FROM orders WHERE sellerId = '$sellerId' AND status = 1";
    $resultTotalIncome = $connection->query($sqlTotalIncome);
    $rowTotalIncome = $resultTotalIncome->fetch_assoc();
    $totalIncome = $rowTotalIncome['totalIncome'];

    // คำนวณยอดเงินที่ผู้ขายสามารถถอนได้
    $sqlTotalWithdrawals = "SELECT SUM(numdraw) AS totalWithdrawals FROM withdrawals WHERE seller_id = '$sellerId'";
    $resultTotalWithdrawals = $connection->query($sqlTotalWithdrawals);
    $rowTotalWithdrawals = $resultTotalWithdrawals->fetch_assoc();
    $totalWithdrawals = $rowTotalWithdrawals['totalWithdrawals'];

    // หัก 6% จากยอดรายได้ที่ผู้ขายสามารถถอนได้
    $withdrawalPercentage = 0.06; // 6% เป็นเปอร์เซนต์
    $deductedAmount = $totalIncome * $withdrawalPercentage;
    $availableWithdrawal = $totalIncome - $deductedAmount - $totalWithdrawals;

    return max($availableWithdrawal, 0); // ไม่สามารถถอนเงินเกินยอดรายได้ที่ผู้ขายขายสินค้าได้
}


function getUsers()
{
    global $connection;
    $userId = $_SESSION['auth_user']['id'];
    $query = "SELECT * FROM users WHERE id ='$userId'";
    return $query_run = mysqli_query($connection, $query);
}



