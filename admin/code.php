<?php

include('../connection/dbcon.php');
include('../funtion/myfunction.php');

//เพิ่มหมวดหมู่สินค้า
if (isset($_POST['add_category_btn'])) 
{
    $name = $_POST['name'];

    $cate_query =  "INSERT INTO category (name) VALUES ('$name') ";

    $cate_query_run = mysqli_query($connection, $cate_query);

    if ($cate_query_run) {
        redirect("add-category.php", "Category Succesfully");
    } else {
        redirect("add-category.php", "Something Went Wrong");
    }
} 
//แก้หมวดหมู่
else if (isset($_POST['update_category_btn'])) 
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];

    $update_query = "UPDATE category SET Name='$name' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) 
    {
        redirect("edit-category.php?id=$category_id", "อัปเดตหมวดหมู่เรียบร้อยแล้ว");
    } 
    else 
    {
        redirect("edit-category.php", "บางอย่างผิดพลาด");
    }
}
//ลบหมวดหมู่สินค้า 
else if (isset($_POST['delete_category_btn'])) 
{
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);

    $delete_query = "DELETE FROM category WHERE id='$category_id' ";
    $delete_query_run  = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        // redirect("category.php", "ลบหมวดหมู่เรียบร้อยแล้ว");
        echo 200;
    } else {
        // redirect("category.php", "บางอย่างผิดพลาด");
        echo 500;
    }
} 
//เพิ่มสินค้า
else if (isset($_POST['add_product_btn'])) 
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $trending = isset($_POST['trending']) ? '1':'0';


    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name != "" && $detail != "") 
    {
        $users_id = $_SESSION['auth_user']['id'];
        $product_query = "INSERT INTO products (category_id,users_id,name,detail,price,num,trending,image) VALUES 
        ('$category_id', $users_id ,'$name','$detail','$price','$num','$trending','$filename') ";

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
//แก้ไขสินค้า
else if (isset($_POST['update_product_btn']))
{
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $trending = isset($_POST['trending']) ? '1':'0';

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

    $update_product_query ="UPDATE products SET category_id='$category_id',name='$name',detail='$detail',price='$price',num='$num',trending='$trending',image='$update_filenname' 
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
//ลบสินค้า
else if(isset($_POST['delete_product_btn']))
{
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id'";
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
        // redirect("manage_users.php", "ลบสินข้อมูลผู้ใช้เรียบร้อยแล้ว");
        echo 200;
    } 
    else 
    {
        // redirect("products.php", "บางอย่างผิดพลาด");
        echo 500;
    }

}
//แก้ไขผู้ใช้
else if (isset($_POST['update_users_btn']))
{
    $users_id = $_POST['users_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $path = "../uploads";

    $new_image = $_FILES['img']['name'];
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

    $update_user_query ="UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`password`='$password',`img`=' $update_filenname' WHERE id ='$users_id'" ;
    $update_user_query_run = mysqli_query($connection, $update_user_query);


    if ($update_user_query_run) 
    {
        if($_FILES['img']['name'] != "")
        {
            move_uploaded_file($_FILES['img']['tmp_name'], $path. '/' .$update_filenname);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("edit-users.php?id=$users_id", "อัปเดตข้อมูลเรียบร้อยแล้ว");
    }
    else
    {
        redirect("edit-users.php?id=$users_id", "มีบางอย่างผิดพลาด");
    }
}
//ลบผู้ใช้
else if(isset($_POST['delete_users_btn']))
{
    $users_id = mysqli_real_escape_string($connection, $_POST['users_id']);

    $user_query = "SELECT * FROM users WHERE id='$users_id'" ;
    $user_query_run = mysqli_query($connection, $user_query);
    $user_data = mysqli_fetch_array($user_query_run);
    $img = $user_data['img'];

    $delete_query = "DELETE FROM users WHERE id='$users_id' ";
    $delete_query_run  = mysqli_query($connection, $delete_query);

    if ($delete_query_run) 
    {
        if(file_exists("../uploads/".$img))
        {
            unlink("../uploads/".$img);
        }
        // redirect("products.php", "ลบสินค้ารียบร้อยแล้ว");
        echo 200;
    } 
    else 
    {
        // redirect("products.php", "บางอย่างผิดพลาด");
        echo 500;
    }

}
//ไม่เข้าเงื่อนไขอะไรด้านบนเลย
else
{
    header('Location : ../index.php');
}
?>