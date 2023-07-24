<?php
session_start();

include('../connection/dbcon.php');
include('../funtion/myfuntion.php');

 if (isset($_POST['add_product_btn'])) 
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];


    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name != "" && $detail != "") 
    {
        $users_id = $_SESSION['auth_user']['id'];
        $product_query = "INSERT INTO products (category_id,users_id,name,detail,price,num,image) VALUES 
        ('$category_id', $users_id ,'$name','$detail','$price','$num','$filename') ";

        $product_query_run = mysqli_query($connection, $product_query);

        if ($product_query_run) 
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

            redirect("add-product.php", "เพิ่มสินค้าสำเร็จแล้ว");
        } 
        else 
        {
            redirect("add-product.php", "มีบางอย่างผิดพลาด");
        }
    } 
    else 
    {
        redirect("add-product.php", "all fields are mandatory");
    }
}

?>