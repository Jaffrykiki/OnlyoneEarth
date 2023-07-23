<?php 
include('../connection/dbcon.php');

function getAll($table)
{
    global $connection;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($connection, $query);
}

// function getByID($table, $id)
// {
//     global $connection;
//     $query = "SELECT * FROM $table WHERE Cat_id ='$id' ";
//     return $query_run = mysqli_query($connection, $query);

// }

function redirect($url, $message) 
{
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}





?>