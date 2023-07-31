<?php 
session_start();
include('../connection/dbcon.php');

//เพิ่่ม
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





?>