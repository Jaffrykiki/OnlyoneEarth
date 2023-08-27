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
    

     // รับชื่อไฟล์รูปภาพที่อัปโหลด
    $image = $_FILES['image']['name'];

    // ตรวจสอบนามสกุลของไฟล์ภาพ
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $allowed_extensions = array('jpg', 'jpeg', 'png'); // นามสกุลที่อนุญาตให้อัปโหลด

    if (in_array($image_ext, $allowed_extensions)) {

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
        $product_query = "INSERT INTO products (category_id,users_id,name,detail,price,num,image) VALUES 
        ('$category_id', $users_id ,'$name','$detail','$price','$num','$filename') ";

        // ประมวลผลคำสั่ง SQL และการอัปโหลดไฟล์ภาพ
        $product_query_run = mysqli_query($connection, $product_query);

        if ($product_query_run) 
        {
            // ย้ายไฟล์ภาพที่อัปโหลดไปยังตำแหน่งที่กำหนด
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

            // เพิ่มข้อมูล logs ในตาราง products_logs
            $event = "เพิ่มสินค้าใหม่: $name";
            $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', LAST_INSERT_ID(), '$event')";
            $logs_query_run = mysqli_query($connection, $logs_query);

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
}    else {
    // นำทางไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน "สกุลไฟล์ไม่ถูกต้อง"
    redirect("add-product.php", "สกุลไฟล์ไม่ถูกต้อง");
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
        // ดึงค่า id ของผู้ใช้จาก session
        $users_id = $_SESSION['auth_user']['id'];

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
        // เพิ่มข้อมูล logs ในตาราง products_logs
        $event = "แก้ไขสินค้า";
        $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', '$product_id', '$event')";
        $logs_query_run = mysqli_query($connection, $logs_query);
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
    // รับค่า product_id จากฟอร์มและทำการ escape เพื่อป้องกันการโจมตี SQL Injection
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลสินค้าที่จะลบ
    $product_query = "SELECT * FROM products WHERE id='$product_id'" ;

    // ประมวลผลคำสั่ง SQL เพื่อเลือกข้อมูลสินค้า
    $product_query_run  = mysqli_query($connection, $product_query);

    // ดึงข้อมูลสินค้าที่ได้จากการเลือก
    $product_data = mysqli_fetch_array($product_query_run);

    // รับชื่อไฟล์รูปภาพสินค้า
    $image = $product_data['image'];

    // เพิ่มข้อมูล logs ในตาราง products_logs
    $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
    $event = "ลบสินค้า";
    $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', '$product_id', '$event')";
    $logs_query_run = mysqli_query($connection, $logs_query);


    if ($logs_query_run) 
    {
        // ตรวจสอบว่ามีไฟล์รูปเก่าในตำแหน่งเก็บไฟล์หรือไม่ และลบไฟล์รูปเก่า
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        
        // สร้างคำสั่ง SQL สำหรับลบข้อมูลสินค้า
        $delete_query = "DELETE FROM products WHERE id='$product_id' ";

        // ประมวลผลคำสั่ง SQL เพื่อลบข้อมูลสินค้า
        $delete_query_run  = mysqli_query($connection, $delete_query);

        if ($delete_query_run) {
            echo 200; // สำเร็จ: HTTP 200 OK
        } else {
            echo 500; // ผิดพลาด: HTTP 500 Internal Server Error
        }
    } else {
        echo 500; // ผิดพลาด: HTTP 500 Internal Server Error
    }
}
// เช็คว่ามีการส่งข้อมูลผ่านการ POST มาหรือไม่ ถ้ากดปุ่ม update_order_btn 
else if(isset($_POST['update_order_btn'])) {
    
    // รับค่า tracking_no และ order_status จากฟอร์ม
    $track_no = $_POST['tracking_no'];
    $order_status =$_POST['order_status'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตสถานะคำสั่งซื้อ
    $updateOrder_query = "UPDATE orders SET status= '$order_status' WHERE tracking_no= '$track_no' ";

    // ทำงานคำสั่ง SQL สำหรับอัปเดตสถานะคำสั่งซื้อ
    $updateOrder_query_run = mysqli_query($connection, $updateOrder_query);

    if ($updateOrder_query_run) {
        // สำเร็จในการอัปเดตหมวดหมู่
        // เพิ่ม Logs เข้าสู่ตาราง order_logs
        $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
        
        // กำหนดข้อความที่เกี่ยวข้องกับสถานะในตัวแปร $event
        if ($order_status == 0) {
            $event = "อัปเดตออเดอร์: อยู่ระหว่างดำเนินการ";
        } elseif ($order_status == 1) {
            $event = "อัปเดตออเดอร์: ดำเนินการแล้ว";
        } elseif ($order_status == 2) {
            $event = "อัปเดตออเดอร์: ยกเลิกคำสั่งซื้อ";
        }

         // สร้างคำสั่ง SQL เพื่อเลือก id จากตาราง orders โดยใช้เงื่อนไข tracking_no
         $select_order_id_query = "SELECT id FROM orders WHERE tracking_no = '$track_no'";
         $select_order_id_result = mysqli_query($connection, $select_order_id_query);
         $order_id_row = mysqli_fetch_assoc($select_order_id_result);
         $order_id = $order_id_row['id'];

         $insert_logs_query = "INSERT INTO orders_logs (u_id , ord_id  , event) VALUES ('$users_id', '$order_id', '$event')";
         mysqli_query($connection, $insert_logs_query);

        // หลังจากอัปเดตสถานะคำสั่งซื้อเสร็จสมบูรณ์ ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าและแสดงข้อความผลลัพธ์
        redirect("view-order.php?t=$track_no", "อัปเดตสถานะคำสั่งซื้อสำเร็จแล้ว");
    } else {
        // ถ้าไม่สำเร็จ redirect ไปยังหน้า "edit-category.php" พร้อมแสดงข้อความ "มีบางอย่างผิดพลาด"
        redirect("view-order.php?t=$track_no", "บางอย่างผิดพลาด");
    }
}
// ถ้าไม่เข้าเงื่อนไขใดเลย ให้เปลี่ยนเส้นทางไปยังหน้า ../index.php
else 
{
    // นำทางไปยังหน้า "../index.php"
    header('Location : ../index.php');
}
?>