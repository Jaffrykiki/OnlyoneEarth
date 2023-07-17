<?php
session_start();

include('../connection/dbcon.php');
include('../funtion/myfuntion.php');

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];

    $cate_query =  "INSERT INTO table_product_category (name) VALUES ('$name') ";

    $cate_query_run = mysqli_query($connection, $cate_query);

    if($cate_query_run)
    {
        redirect("add-category.php", "Category Succesfully");
    }   
    else
    {
        redirect("add-category.php", "Something Went Wrong");
    }



}


?>