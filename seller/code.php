<?php
include('../connection/dbcon.php');
include('../funtion/myfunction.php');


// เมื่อกดปุ่ม "เพิ่มสินค้า"
if (isset($_POST['add_product_btn'])) {
    // รับค่าต่าง ๆ จากฟอร์ม
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $detail = $_POST['detail'];
    $price = $_POST['price'];
    $num = $_POST['num'];


    // กำหนดโฟลเดอร์ที่เก็บรูปภาพ
    $path = "../uploads";

    // ตรวจสอบว่ามีชื่อและรายละเอียดต้องไม่ว่าง
    if ($name != "" && $detail != "") {
        // ดึงค่า id ของผู้ใช้จาก session
        $users_id = $_SESSION['auth_user']['id'];

        // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลสินค้าในฐานข้อมูล
        $product_query = "INSERT INTO products (category_id,users_id,name,detail,price,num) VALUES 
        ('$category_id', $users_id ,'$name','$detail','$price','$num') ";

        // ทำการ query คำสั่ง SQL และเก็บผลลัพธ์ในตัวแปร $product_query_run
        $product_query_run = mysqli_query($connection, $product_query);

        // ตรวจสอบผลลัพธ์การ query เพื่อทำการเปลี่ยนเส้นทางหน้าเว็บ
        if ($product_query_run) {

            $product_id = mysqli_insert_id($connection); // ได้ ID ของสินค้าที่เพิ่มล่าสุด

            $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');

            foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
                $image = $_FILES['images']['name'][$index];
                $image_ext = pathinfo($image, PATHINFO_EXTENSION);

                if (in_array(strtolower($image_ext), $allowed_extensions)) {
                    $filename = time() . '_' . $index . '.' . $image_ext;

                    $product_image_query = "INSERT INTO product_images (product_id, image_filename) VALUES ('$product_id', '$filename')";
                    $product_image_query_run = mysqli_query($connection, $product_image_query);

                    if ($product_image_query_run) {
                        move_uploaded_file($tmp_name, $path . '/' . $filename);
                    } else {
                        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
                        redirect("add-product.php", "มีบางอย่างผิดพลาด");
                    }
                } else {
                    // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
                    redirect("add-product.php", "ประเภทไฟล์ไม่ถูกต้อง");
                }
            }


            // เพิ่มข้อมูล logs ในตาราง products_logs
            $event = "เพิ่มสินค้าใหม่: $name";
            $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id','$product_id', '$event')";
            $logs_query_run = mysqli_query($connection, $logs_query);

            // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
            redirect("add-product.php", "เพิ่มสินค้าสำเร็จแล้ว");
        } else {
            // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "add-product.php" พร้อมกับข้อความแจ้งเตือน
            redirect("add-product.php", "มีบางอย่างผิดพลาด");
        }
    }
}
//  ถ้ากดปุ่ม update_product_btn
else if (isset($_POST['update_product_btn'])) {

    // รับค่า product_id และ category_id จากฟอร์ม
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $category_id = mysqli_real_escape_string($connection, $_POST['category_id']);
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $detail = mysqli_real_escape_string($connection, $_POST['detail']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $num = mysqli_real_escape_string($connection, $_POST['num']);

    // ดึงค่า id ของผู้ใช้จาก session
    $users_id = $_SESSION['auth_user']['id'];

    // เพิ่มข้อมูล logs ในตาราง products_logs
    $event = "แก้ไขสินค้า";
    $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', '$product_id', '$event')";
    $logs_query_run = mysqli_query($connection, $logs_query);

    if ($logs_query_run) {

        // สร้างคำสั่ง SQL สำหรับอัปเดตข้อมูลสินค้า
        $update_product_query = "UPDATE products SET category_id='$category_id',name='$name',detail='$detail',price='$price',num='$num' 
        WHERE  id ='$product_id'";

        // ทำงานคำสั่ง SQL สำหรับอัปเดตข้อมูลสินค้า
        $update_product_query_run = mysqli_query($connection, $update_product_query);

        if ($update_product_query_run) {

            // รับข้อมูลรูปภาพใหม่และรูปภาพเดิมจากฟอร์ม
            $new_images = $_FILES['images']['name'];
            $old_images_str = $_POST['old_images']; // รับค่าจากฟอร์ม
            $old_images = explode(',', $old_images_str); // แยกสตริงเป็นอาร์เรย์

            // กำหนดโฟลเดอร์ที่เก็บรูปภาพ
            $path = "../uploads";

                        // ลบรูปภาพเก่าทั้งหมดในโฟลเดอร์
                        foreach ($old_images as $old_image) {
                            $old_image_path = $path . '/' . $old_image;
                            if (file_exists($old_image_path)) {
                                unlink($old_image_path);
                            }
                        }

                        // วนลูปเพื่ออัปเดตรูปภาพในตาราง product_images
                        foreach ($new_images as $key => $new_image) {
                            if ($new_image != "") {
                                // ดึงนามสกุลไฟล์ภาพใหม่
                                $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
                                // สร้างชื่อไฟล์ใหม่ที่ไม่ซ้ำกันด้วยเวลาปัจจุบันและนามสกุลไฟล์
                                $update_filename = time() . '_' . $key . '.' . $image_ext;
            
                                // อัปโหลดไฟล์ภาพใหม่ไปยังโฟลเดอร์ที่กำหนด
                                move_uploaded_file($_FILES['images']['tmp_name'][$key], $path . '/' . $update_filename);
            
                                // อัปเดตชื่อไฟล์รูปภาพในตาราง product_images
                                $update_image_query = "UPDATE product_images SET image_filename='$update_filename' WHERE product_id='$product_id' AND image_filename='$old_images[$key]'";
                                $update_image_query_run = mysqli_query($connection, $update_image_query);
            
                                if (!$update_image_query_run) {
                                    // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน
                                    redirect("edit-product.php?id=$product_id", "มีบางอย่างผิดพลาด");
                                    exit; // จบการทำงานทันทีหลังจาก redirect
                                }
                            }
                        }
                        // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน
                        redirect("edit-product.php?id=$product_id", "อัพเดดสินค้าเรียบร้อยแล้ว");
                        exit; // จบการทำงานทันทีหลังจาก redirect
        } else {
            // ใช้ฟังก์ชัน redirect เพื่อเปลี่ยนเส้นทางหน้าไปยังหน้า "edit-product.php" พร้อมกับข้อความแจ้งเตือน
            redirect("edit-product.php?id=$product_id", "มีบางอย่างผิดพลาด");
        }
    }
}
// ถ้ากดปุ่ม delete_product_btn 
else if (isset($_POST['delete_product_btn'])) {
    // รับค่า product_id จากฟอร์มและทำการ escape เพื่อป้องกันการโจมตี SQL Injection
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);

    // สร้างคำสั่ง SQL เพื่อเลือกข้อมูลสินค้าที่จะลบ
    $product_query = "SELECT products.name, product_images.image_filename
    FROM products
    JOIN product_images ON products.id = product_images.product_id
    WHERE products.id = '$product_id'";

    // ประมวลผลคำสั่ง SQL เพื่อเลือกข้อมูลสินค้า
    $product_query_run  = mysqli_query($connection, $product_query);

    // ดึงข้อมูลสินค้าที่ได้จากการเลือก
    $product_data = mysqli_fetch_array($product_query_run);


    // เพิ่มข้อมูล logs ในตาราง products_logs
    $users_id = $_SESSION['auth_user']['id']; // แทนที่ด้วยรหัสผู้ใช้งานจริง
    $product_name = $product_data['name'];
    $event = "ลบสินค้า:$product_name";
    $logs_query = "INSERT INTO products_logs (u_id, p_id, event) VALUES ('$users_id', '$product_id', '$event')";
    $logs_query_run = mysqli_query($connection, $logs_query);

    // ดึงข้อมูลรูปภาพที่เกี่ยวข้องกับสินค้าที่จะลบ
    $product_images_query = "SELECT image_filename FROM product_images WHERE product_id = '$product_id'";
    $product_images_result = mysqli_query($connection, $product_images_query);

    // วนลูปเพื่อลบรูปภาพทั้งหมด
    while ($product_image_data = mysqli_fetch_assoc($product_images_result)) {
        $image_filename = $product_image_data['image_filename'];
        $image_path = "../uploads/" . $image_filename;

        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    if ($product_images_result) {
        // สร้างคำสั่ง SQL สำหรับลบข้อมูลสินค้า
        $delete_query = "DELETE FROM products WHERE id='$product_id' ";
        // ประมวลผลคำสั่ง SQL เพื่อลบข้อมูลสินค้า
        $delete_query_run  = mysqli_query($connection, $delete_query);

        if ($delete_query_run) {
            echo 200; // สำเร็จ: HTTP 200 OK
        } else {
            echo 500; // ผิดพลาด: HTTP 500 Internal Server Error
        }
    }
}
// ถ้ากดปุ่ม update_order_btn 
else if (isset($_POST['update_order_btn'])) {

    // รับค่า tracking_no และ order_status จากฟอร์ม
    $track_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

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
else {
    // นำทางไปยังหน้า "../index.php"
    header('Location : ../index.php');
}
