<?php 
session_start();
include('connection/dbcon.php');

function getAllActive($table)
{  
    //query ข้อมูลหมวดหมู่มาเก็บในFunction
    global $connection;
    $query = "SELECT * FROM `category` ";  
    return $query_run = mysqli_query($connection, $query);
}
function redirect($url, $message) 
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}


?> 