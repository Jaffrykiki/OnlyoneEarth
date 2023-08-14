<?php 

session_start();

include('../connection/dbcon.php');

// การยกเลิกคำสั่งซื้อ
if(isset($_POST['cancel_order'])) {

    // รับค่า tracking_no และ newStatus จากฟอร์ม
    $tracking_no = $_POST["tracking_no"];
    $newStatus = $_POST["status"];

    // อัพเดตสถานะคำสั่งซื้อเพื่อยกเลิก
    $update_query = "UPDATE orders SET status = $newStatus WHERE tracking_no = '$tracking_no'";
    $update_query_run = mysqli_query($connection, $update_query);
    if($update_query_run){
        $_SESSION['message'] = "ยกเลิกคำสั่งซื้อเรียบร้อยแล้ว";
        header('Location: ../view-order.php?t='.$tracking_no);
        die();
    }
    else {
        redirect("../view-order.php?t=$tracking_no", "เกิดข้อผิดพลาด");
    }
}

else if (isset($_SESSION['auth'])) 
{
    // $payment_id = null;
    if(isset($_POST['placeOrderBtn']))
    {   
        // รับข้อมูลจากฟอร์มสำหรับการสั่งซื้อ
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $pincode = mysqli_real_escape_string($connection, $_POST['pincode']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($connection, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
        // if ($payment_id === null) {
        //     $payment_id = "null"; // เปลี่ยนเป็นสตริงที่ถูกต้อง
        // } else {
        //     $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
        // }
        
            // ตรวจสอบข้อมูลที่กรอกในฟอร์ม
        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "")
        {
            $_SESSION['message'] = "คุณกรอกข้อมูลไม่ครบถ้วน";
            header('Location: ../checkout.php');
            exit(0);
        } 

        $userId = $_SESSION['auth_user']['id'];
        // ดึงสินค้าในตะกร้าของผู้ใช้
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.price, p.users_id 
            FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC  ";

        $query_run = mysqli_query($connection, $query);

        // ดึงสินค้าในตะกร้าของผู้ใช้
        $totalPrice = 0;
        foreach ($query_run as $citem) 
        {
            $totalPrice += $citem['price'] * $citem['prod_qty'];
        }

        //เพิ่มข้อมูลเข้าไปในตาราง orders
        $tracking_no = "Somtuy".rand(1111,9999).substr($phone,2);
        $insert_query = "INSERT INTO orders (user_id, tracking_no, name, email, phone, address, pincode, total_price, payment_mode, payment_id ) VALUES ('$userId','$tracking_no', '$name', '$email', '$phone', '$address', '$pincode', '$totalPrice', '$payment_mode', '$payment_id') ";
        $insert_query_run = mysqli_query($connection, $insert_query);
       
        if($insert_query_run)
        {
            $order_id = mysqli_insert_id($connection);
            foreach ($query_run as $citem) 
            {
                // เพิ่มรายการสินค้าในตาราง order_items
                $prod_id = $citem['prod_id'];
                $user_id = $citem['users_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['price'];

                $insert_items_qurty = "INSERT INTO order_items (order_id, prod_id,user_id,qty, price) VALUES 
                ('$order_id', '$prod_id','$user_id', '$prod_qty', '$price') ";
                $insert_items_qurty_run = mysqli_query($connection, $insert_items_qurty);

                // อัพเดตจำนวนสินค้าในตาราง products
                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1 ";
                $product_query_run = mysqli_query($connection, $product_query);

                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['num'];

                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = "UPDATE products SET num='$new_qty' WHERE id='$prod_id'";
                $updateQty_query_run = mysqli_query($connection, $updateQty_query);
            }

            // ลบรายการสินค้าในตะกร้าหลังสั่งซื้อ
            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userId'";
            $deleteCartQuery_run = mysqli_query($connection , $deleteCartQuery);
            
            if($payment_mode == "COD")
            {
                $_SESSION['message'] = "สั่งซื้อสินค้าเรียบร้อยแล้ว";
                header('Location: ../my-orders.php');
                die();
            }else{
                echo 201;
            }
        }
    }
}

else  {
    header('Location: ../index.php');
}

?>