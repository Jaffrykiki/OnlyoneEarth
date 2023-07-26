<?php
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
else if (isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];

    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        //update_filename =$new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filenname = time().'.'.$image_ext;
    }
    else
    {
        $update_filenname = $old_image;
    }

    $update_product_query ="UPDATE products SET category_id='$category_id',name='$name',detail='$detail',price='$price',num='$num',image='$update_filenname' 
    WHERE  id ='$product_id'";
    $update_product_query_run = mysqli_query($connection, $update_product_query);


    if ($update_product_query_run) 
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path. '/' .$update_filenname);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "อัปเดตสินค้าเรียบร้อยแล้ว");
    }
    else
    {
        redirect("edit-product.php?id=$product_id", "มีบางอย่างผิดพลาด");
    }
}
else if(isset($_POST['delete_product_btn']))
{
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'" ;
    $product_query_run  = mysqli_query($connection, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run  = mysqli_query($connection, $delete_query);



    if ($delete_query_run) 
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }

        // redirect("products.php", "ลบสินค้ารียบร้อยแล้ว");
        echo 200;
    } 
    else 
    {
        // redirect("products.php", "บางอย่างผิดพลาด");
        echo 700;
    }

}
else
{
    header('Location : ../index.php');
}
?>