<?php

include('../connection/dbcon.php');
include('../funtion/myfunction.php');

// เมื่อกดปุ่ม "เพิ่มหมวดหมู่สินค้า"
if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];

    // ตรวจสอบว่าชื่อหมวดหมู่นี้มีอยู่ในฐานข้อมูลหรือไม่
    $check_query = "SELECT * FROM category WHERE name = '$name'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // หมวดหมู่มีอยู่แล้ว แสดงข้อความหรือกระทำที่คุณต้องการ
        redirect("add-category.php", "หมวดหมู่นี้มีอยู่แล้วในระบบ");
    } else {

        // สร้างคำสั่ง SQL สำหรับเพิ่มหมวดหมู่
        $cate_query =  "INSERT INTO category (name) VALUES ('$name') ";

        // รันคำสั่ง SQL
        $cate_query_run = mysqli_query($connection, $cate_query);

        if ($cate_query_run) {

            // บันทึก logs เมื่อสำเร็จ

            $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
            $cat_id = mysqli_insert_id($connection); // รหัสหมวดหมู่ที่เพิ่มล่าสุด
            $event = "เพิ่มหมวดหมู่:$name";

            $logs_query = "INSERT INTO category_logs (user_id, cat_id, event) VALUES ('$users_id', '$cat_id', '$event')";

            $logs_query_run = mysqli_query($connection, $logs_query);

            // ถ้าสำเร็จ redirect ไปยังหน้า "add-category.php" พร้อมแสดงข้อความ "เพิ่มหมวดหมู่สินค้าเรียบร้อยแล้ว"
            redirect("add-category.php", "เพิ่มหมวดหมู่สินค้าเรียบร้อยแล้ว");
        } else {
            // ถ้าไม่สำเร็จ redirect ไปยังหน้า "add-category.php" พร้อมแสดงข้อความ "มีบางอย่างผิดพลาด"
            redirect("add-category.php", "มีบางอย่างผิดพลาด");
        }
    }
}
// เมื่อกดปุ่ม "อัปเดตหมวดหมู่สินค้า" 
else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];

    // สร้างคำสั่ง SQL สำหรับอัปเดตชื่อหมวดหมู่
    $update_query = "UPDATE category SET Name='$name' WHERE id='$category_id' ";

    // รันคำสั่ง SQL
    $update_query_run = mysqli_query($connection, $update_query);

    if ($update_query_run) {
        // สำเร็จในการอัปเดตหมวดหมู่

        // เพิ่ม Logs เข้าสู่ตาราง category_logs
        $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
        $event = "อัปเดตชื่อหมวดหมู่:$name";

        $insert_logs_query = "INSERT INTO category_logs (user_id, cat_id, event) VALUES ('$users_id', '$category_id', '$event')";
        mysqli_query($connection, $insert_logs_query);

        // ถ้าสำเร็จ redirect ไปยังหน้า "edit-category.php" พร้อมแสดงข้อความ "อัปเดตหมวดหมู่สินค้าเรียบร้อยแล้ว"
        redirect("edit-category.php?id=$category_id", "อัปเดตหมวดหมู่เรียบร้อยแล้ว");
    } else {
        // ถ้าไม่สำเร็จ redirect ไปยังหน้า "edit-category.php" พร้อมแสดงข้อความ "มีบางอย่างผิดพลาด"
        redirect("edit-category.php", "บางอย่างผิดพลาด");
    }
}
// เมื่อกดปุ่ม "ลบหมวดหมู่สินค้า" 
else if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);

    // เพิ่มส่วนของการบันทึก logs
    $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
    $event = "ลบหมวดหมู่";

    // สร้างคำสั่ง SQL สำหรับลบหมวดหมู่
    $log_insert_query = "INSERT INTO category_logs (user_id, cat_id, event) VALUES ('$users_id', '$category_id', '$event')";

    // รันคำสั่ง SQL
    $log_insert_query_run = mysqli_query($connection, $log_insert_query);


    if ($log_insert_query_run) {

        $delete_query = "DELETE FROM category WHERE id='$category_id' ";
        $delete_query_run = mysqli_query($connection, $delete_query);

        if ($delete_query_run) {
            echo 200; // สำเร็จ: HTTP 200 OK
        } else {
            echo 500; // ผิดพลาด: HTTP 500 Internal Server Error
        }
    } else {
        echo 500; // ผิดพลาด: HTTP 500 Internal Server Error
    }
}
// เมื่อกดปุ่ม "เพิ่มสินค้า"
else if (isset($_POST['add_product_btn'])) {
    // รับค่าต่าง ๆ จากฟอร์ม
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $trending = isset($_POST['trending']) ? '1' : '0';

    // รับชื่อไฟล์รูปภาพ
    $image = $_FILES['image']['name'];

    // กำหนดโฟลเดอร์ที่เก็บรูปภาพ
    $path = "../uploads";

    // ดึงนามสกุลไฟล์ภาพ
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);

    // สร้างชื่อไฟล์ใหม่ที่ไม่ซ้ำกันด้วยการใช้เวลาปัจจุบันและนามสกุลไฟล์
    $filename = time() . '.' . $image_ext;

    // ตรวจสอบว่ามีชื่อและรายละเอียดต้องไม่ว่าง
    if ($name != "" && $detail != "") {
        // ดึงค่า id ของผู้ใช้จาก session
        $users_id = $_SESSION['auth_user']['id'];

        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลสินค้าในฐานข้อมูล
        $product_query = "INSERT INTO products (category_id,users_id,name,detail,price,num,trending,image) VALUES 
        ('$category_id', $users_id ,'$name','$detail','$price','$num','$trending','$filename') ";

        // ทำการ query คำสั่ง SQL และเก็บผลลัพธ์ในตัวแปร $product_query_run
        $product_query_run = mysqli_query($connection, $product_query);

        // ตรวจสอบผลลัพธ์การ query เพื่อทำการเปลี่ยนเส้นทางหน้าเว็บ
        if ($product_query_run) {
            // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ที่กำหนด
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

            // เพิ่มข้อมูล logs ในตาราง products_logs
            $event = "เพิ่มสินค้าใหม่: $name";
            $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', LAST_INSERT_ID(), '$event')";
            $logs_query_run = mysqli_query($connection, $logs_query);

            // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
            redirect("add-product.php", "เพิ่มสินค้าสำเร็จแล้ว");
        } else {
            // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
            redirect("add-product.php", "มีบางอย่างผิดพลาด");
        }
    } else {
        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
        redirect("add-product.php", "all fields are mandatory");
    }
}
// เมื่อกดปุ่ม "อัปเดตสินค้า"
else if (isset($_POST['update_product_btn'])) {
    // รับค่า product_id และ category_id จากฟอร์ม
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    // รับข้อมูลสินค้า
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $trending = isset($_POST['trending']) ? '1' : '0';

    // กำหนดโฟลเดอร์ที่เก็บรูปภาพ
    $path = "../uploads";

    // รับชื่อไฟล์รูปภาพใหม่และรูปภาพเก่า
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    // ตรวจสอบว่ามีการเลือกไฟล์รูปใหม่หรือไม่
    if ($new_image != "") {
        // ดึงนามสกุลไฟล์ภาพใหม่
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        // สร้างชื่อไฟล์ใหม่ที่ไม่ซ้ำกันด้วยเวลาปัจจุบันและนามสกุลไฟล์
        $update_filenname = time() . '.' . $image_ext;
    } else {
        // ใช้ชื่อไฟล์เดิม
        $update_filenname = $old_image;
    }

    // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูลสินค้าในฐานข้อมูล
    $update_product_query = "UPDATE products SET category_id='$category_id',name='$name',detail='$detail',price='$price',num='$num',trending='$trending',image='$update_filenname' 
    WHERE  id ='$product_id'";

    // ทำการ query คำสั่ง SQL และเก็บผลลัพธ์ในตัวแปร $update_product_query_run
    $update_product_query_run = mysqli_query($connection, $update_product_query);


    // ตรวจสอบผลลัพธ์การ query เพื่อทำการเปลี่ยนเส้นทางหน้าเว็บ
    if ($update_product_query_run) {
        // ดึงค่า id ของผู้ใช้จาก session
        $users_id = $_SESSION['auth_user']['id'];

        // ตรวจสอบว่ามีการเลือกไฟล์รูปใหม่หรือไม่
        if ($_FILES['image']['name'] != "") {
            // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ที่กำหนด
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filenname);
            // ตรวจสอบว่ามีไฟล์รูปภาพเก่าอยู่ในโฟลเดอร์ และลบไฟล์รูปภาพเก่า
            if (file_exists("../uploads/" . $old_image)) 
            {
                unlink("../uploads/" . $old_image);
            }
        }
        // เพิ่มข้อมูล logs ในตาราง products_logs
        $event = "แก้ไขสินค้า";
        $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', '$product_id', '$event')";
        $logs_query_run = mysqli_query($connection, $logs_query);

        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน
        redirect("edit-product.php?id=$product_id", "อัปเดตสินค้าเรียบร้อยแล้ว");
    } else {
        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน
        redirect("edit-product.php?id=$product_id", "มีบางอย่างผิดพลาด");
    }
}
// เมื่อกดปุ่ม "ลบสินค้า"
else if (isset($_POST['delete_product_btn'])) {
    // รับค่า product_id จากฟอร์มและทำการ escape เพื่อป้องกันการโจมตี SQL Injection
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลสินค้าที่จะลบ
    $product_query = "SELECT * FROM products WHERE id='$product_id'";

    // ประมวลผลคำสั่ง SQL เพื่อเลือกข้อมูลสินค้า
    $product_query_run  = mysqli_query($connection, $product_query);

    // ดึงข้อมูลสินค้าที่จะลบ
    $product_data = mysqli_fetch_array($product_query_run);

    // รับชื่อไฟล์รูปภาพสินค้า
    $image = $product_data['image'];

    // เพิ่มข้อมูล logs ในตาราง products_logs
    $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
    $event = "ลบสินค้า";
    $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', '$product_id', '$event')";
    $logs_query_run = mysqli_query($connection, $logs_query);


    // ตรวจสอบผลลัพธ์การ query เพื่อทำการแสดงข้อความหรือเปลี่ยนเส้นทางหน้า
    if ($logs_query_run) {
        // ตรวจสอบว่ามีไฟล์รูปภาพในโฟลเดอร์และทำการลบไฟล์รูปภาพ
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        // สร้างคำสั่ง SQL เพื่อลบข้อมูลสินค้าที่ตรงกับ product_id
        $delete_query = "DELETE FROM products WHERE id='$product_id'";

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
// เมื่อกดปุ่ม "อัปเดตผู้ใช้"
else if (isset($_POST['update_users_btn'])) {
    // รับค่าจากฟอร์ม 
    $users_id = $_POST['users_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // กำหนดตำแหน่งที่เก็บไฟล์รูปภาพ
    $path = "../uploads";

    // รับค่าไฟล์รูปภาพใหม่และไฟล์รูปภาพเดิม
    $new_image = $_FILES['img']['name'];
    $old_image = $_POST['old_image'];

    // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพใหม่หรือไม่
    if ($new_image != "") {
        // หานามสกุลของไฟล์รูปภาพใหม่
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);

        // สร้างชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบันและนามสกุลของไฟล์
        $update_filenname = time() . '.' . $image_ext;
    } else {
        // ถ้าไม่มีการอัปโหลดไฟล์รูปภาพใหม่ ใช้ชื่อไฟล์เดิม
        $update_filenname = $old_image;
    }

    // สร้างคำสั่ง SQL เพื่ออัปเดตข้อมูลผู้ใช้
    $update_user_query = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`password`='$password',`img`=' $update_filenname' WHERE id ='$users_id'";
    $update_user_query_run = mysqli_query($connection, $update_user_query);


    // ตรวจสอบผลลัพธ์การ query เพื่อทำการแสดงข้อความหรือเปลี่ยนเส้นทางหน้า
    if ($update_user_query_run) {
        // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพใหม่หรือไม่
        if ($_FILES['img']['name'] != "") {
            // ย้ายไฟล์รูปภาพไปยังตำแหน่งที่เก็บ
            move_uploaded_file($_FILES['img']['tmp_name'], $path . '/' . $update_filenname);
            // ตรวจสอบว่ามีไฟล์รูปภาพเดิมในโฟลเดอร์และทำการลบ
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าและแสดงข้อความแจ้งเตือน
        redirect("edit-users.php?id=$users_id", "อัปเดตข้อมูลเรียบร้อยแล้ว");
    } else {
        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าและแสดงข้อความแจ้งเตือน
        redirect("edit-users.php?id=$users_id", "มีบางอย่างผิดพลาด");
    }
}
// เมื่อกดปุ่ม "ลบผู้ใช้"
else if (isset($_POST['delete_users_btn'])) {
    // รับค่า users_id จากฟอร์มและทำการ escape เพื่อป้องกันการโจมตี SQL Injection
    $users_id = mysqli_real_escape_string($connection, $_POST['users_id']);

    // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลผู้ใช้ที่จะถูกลบ
    $user_query = "SELECT * FROM users WHERE id='$users_id'";
    $user_query_run = mysqli_query($connection, $user_query);
    $user_data = mysqli_fetch_array($user_query_run);
    $img = $user_data['img'];

    // สร้างคำสั่ง SQL เพื่อลบข้อมูลผู้ใช้
    $delete_query = "DELETE FROM users WHERE id='$users_id' ";
    $delete_query_run  = mysqli_query($connection, $delete_query);

    // ตรวจสอบผลลัพธ์การ query เพื่อทำการแสดงข้อความหรือเปลี่ยนเส้นทางหน้า
    if ($delete_query_run) {
        // ตรวจสอบว่ามีไฟล์รูปภาพในโฟลเดอร์และทำการลบ
        if (file_exists("../uploads/" . $img)) {
            unlink("../uploads/" . $img);
        }
        // ใช้ echo เพื่อแสดงผลสถานะลบเป็น HTTP Response Code 200
        echo 200;
    } else {
        // ใช้ echo เพื่อแสดงผลสถานะผิดพลาดเป็น HTTP Response Code 500
        echo 500;
    }
}
// เมื่อกดปุ่ม "อัปเดตสถานะคำสั่งซื้อ"
else if (isset($_POST['update_order_btn'])) {
    // รับค่า tracking_no และ order_status จากฟอร์ม
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    // รับค่า tracking_no และ order_status จากฟอร์ม
    $updateOrder_query = "UPDATE orders SET status= '$order_status' WHERE tracking_no= '$track_no' ";
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
else {
    header('Location : ../index.php');
}
