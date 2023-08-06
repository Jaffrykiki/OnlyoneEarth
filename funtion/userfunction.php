<?php 

session_start();
include('connection/dbcon.php');

    //query ข้อมูลหมวดหมู่สินค้า
function getAllActive($table)
{  
    global $connection;
    $query = "SELECT * FROM `$table` ";  
    return $query_run = mysqli_query($connection, $query);
}

//ชื่อหมวดหมู่สินค้า
function getNameActive($table, $name)
{
    global $connection;
    $query = "SELECT * FROM $table WHERE  name ='$name' ";
    return $query_run = mysqli_query($connection, $query);

}

//query ข้อมูลสินค้า
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

//แสดงรายการสินค้าในตระกร้า
function getCartItems()
{
    global $connection;
    $userId = $_SESSION['auth_user']['id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.price 
     FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC  ";
     return $query_run = mysqli_query($connection, $query);
}

//เก็บข้อความ
function redirect($url, $message) 
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}


?> 