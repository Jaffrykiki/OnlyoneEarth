<?php
include('../connection/dbcon.php');
include('../funtion/myfunction.php');

// เช็คว่ามีการส่งข้อมูลผ่านการ POST มาหรือไม่ ถ้ากดปุ่ม add_product_btn
 if (isset($_POST['add_product_btn'])) 
{
    // รับค่าจากฟอร์ม
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $trending = isset($_POST['trending']) ? '1':'0';

     // รับชื่อไฟล์รูปภาพที่อัปโหลด
    $image = $_FILES['image']['name'];

    // กำหนดตำแหน่งที่เก็บไฟล์
    $path = "../uploads";

    // แยกนามสกุลไฟล์ภาพและสร้างชื่อใหม่
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // เช็คข้อมูลที่รับมาจากฟอร์ม
    if ($name != "" && $detail != "") 
    {
        // รับค่า ID ของผู้ใช้จากเซสชัน
        $users_id = $_SESSION['auth_user']['id'];

        // สร้างคำสั่ง SQL สำหรับเพิ่มสินค้าลงในฐานข้อมูล
        $product_query = "INSERT INTO products (category_id,users_id,name,detail,price,num,trending,image) VALUES 
        ('$category_id', $users_id ,'$name','$detail','$price','$num','$trending','$filename') ";

        // ประมวลผลคำสั่ง SQL และการอัปโหลดไฟล์ภาพ
        $product_query_run = mysqli_query($connection, $product_query);

        if ($product_query_run) 
        {
            // ย้ายไฟล์ภาพที่อัปโหลดไปยังตำแหน่งที่กำหนด
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

            // นำทางไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน "เพิ่มสินค้าสำเร็จแล้ว"
            redirect("add-product.php", "เพิ่มสินค้าสำเร็จแล้ว");
        } 
        else 
        {
            // นำทางไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน "มีบางอย่างผิดพลาด"
            redirect("add-product.php", "มีบางอย่างผิดพลาด");
        }
    } 
    else 
    {
        // นำทางไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน "all fields are mandatory"
        redirect("add-product.php", "all fields are mandatory");
    }
}
// เช็คว่ามีการส่งข้อมูลผ่านการ POST มาหรือไม่ ถ้ากดปุ่ม update_product_btn
else if (isset($_POST['update_product_btn']))
{
    // รับค่าจากฟอร์ม
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];

     // กำหนดตำแหน่งที่เก็บไฟล์
    $path = "../uploads";

    // รับชื่อไฟล์รูปภาพใหม่และเก่า
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
    if($new_image != "")
    {
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filenname = time().'.'.$image_ext;
    }
    else
    {
        // ใช้ชื่อภาพเก่า
        $update_filenname = $old_image;
    }

    // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลสินค้า
    $update_product_query ="UPDATE products SET category_id='$category_id',name='$name',detail='$detail',price='$price',num='$num',image='$update_filenname' 
    WHERE  id ='$product_id'";

    // ทำงานคำสั่ง SQL สำหรับอัปเดตข้อมูลสินค้า
    $update_product_query_run = mysqli_query($connection, $update_product_query);


    if ($update_product_query_run) 
    {
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
        if($_FILES['image']['name'] != "")
        {
            // ย้ายไฟล์ภาพใหม่ไปยังตำแหน่งที่กำหนด
            move_uploaded_file($_FILES['image']['tmp_name'], $path. '/' .$update_filenname);

            // ตรวจสอบว่ามีไฟล์รูปเก่าในตำแหน่งเก็บไฟล์หรือไม่ และลบไฟล์รูปเก่า
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        // นำทางไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน "อัปเดตสินค้าเรียบร้อยแล้ว"
        redirect("edit-product.php?id=$product_id", "อัปเดตสินค้าเรียบร้อยแล้ว");
    }
    else
    {
        // นำทางไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน "อัปเดตสินค้าเรียบร้อยแล้ว"
        redirect("edit-product.php?id=$product_id", "มีบางอย่างผิดพลาด");
    }
}
// เช็คว่ามีการส่งข้อมูลผ่านการ POST มาหรือไม่ ถ้ากดปุ่ม delete_product_btn 
else if(isset($_POST['delete_product_btn']))
{
    // รับค่าจากฟอร์ม
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    // สร้างคำสั่ง SQL สำหรับเลือกข้อมูลสินค้า
    $product_query = "SELECT * FROM products WHERE id='$product_id'" ;

    // ประมวลผลคำสั่ง SQL เพื่อเลือกข้อมูลสินค้า
    $product_query_run  = mysqli_query($connection, $product_query);

    // ดึงข้อมูลสินค้าที่ได้จากการเลือก
    $product_data = mysqli_fetch_array($product_query_run);

    // รับชื่อไฟล์รูปภาพสินค้า
    $image = $product_data['image'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูลสินค้า
    $delete_query = "DELETE FROM products WHERE id='$product_id' ";

    // ประมวลผลคำสั่ง SQL เพื่อลบข้อมูลสินค้า
    $delete_query_run  = mysqli_query($connection, $delete_query);



    if ($delete_query_run) 
    {
        // ตรวจสอบว่ามีไฟล์รูปเก่าในตำแหน่งเก็บไฟล์หรือไม่ และลบไฟล์รูปเก่า
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }

        // แสดงผลสถานะลบสำเร็จผ่านรหัส HTTP 200 (OK)
        echo 200;
    } 
    else 
    {
        // แสดงผลสถานะลบสำเร็จผ่านรหัส HTTP 200 (OK)
        echo 700;
    }

}
// เช็คว่ามีการส่งข้อมูลผ่านการ POST มาหรือไม่ ถ้ากดปุ่ม update_order_btn 
else if(isset($_POST['update_order_btn'])) {
    
    // รับค่าจากฟอร์ม
    $track_no = $_POST['tracking_no'];
    $order_status =$_POST['order_status'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตสถานะคำสั่งซื้อ
    $updateOrder_query = "UPDATE orders SET status= '$order_status' WHERE tracking_no= '$track_no' ";

    // ทำงานคำสั่ง SQL สำหรับอัปเดตสถานะคำสั่งซื้อ
    $updateOrder_query_run = mysqli_query($connection, $updateOrder_query);

    // นำทางไปยังหน้า "view-order.php" พร้อมกับข้อความแจ้งเตือน "อัปเดตสถานะคำสั่งซื้อสำเร็จแล้ว"
    redirect("view-order.php?t=$track_no", "อัปเดตสถานะคำสั่งซื้อสำเร็จแล้ว");

}
// เมื่อไม่มีเงื่อนไขที่ตรงกับการตรวจสอบ POST ที่กำหนดมาก่อนหน้านี้
else 
{
    // นำทางไปยังหน้า "../index.php"
    header('Location : ../index.php');
}
?>