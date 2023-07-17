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
else if (isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    
    $update_query = "UPDATE table_product_category SET Name='$name' WHERE Cat_id='$category_id' ";

    $update_query_run = mysqli_query($connection, $update_query);

    if($update_query_run)
    {
        redirect("edit-category.php?id=$category_id","Category Update Succesfully");
    }   
    else
    {
        redirect("edit-category.php", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);

    $delete_query = "DELETE FROM table_product_category WHERE Cat_id='$category_id' ";
    $delete_query_run  = mysqli_query($connection, $delete_query);

    if($delete_query_run)
    {
        redirect("category.php","Category Delete Succesfully");
    }
    else {
        redirect("category.php","Something Went Wrong");
    }
}

?>