<?php 

session_start();

include('../connection/dbcon.php');


if (isset($_SESSION['auth'])) 
{

    $payment_id = null;
    if(isset($_POST['placeOrderBtn']))
    {   
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $phone = mysqli_real_escape_string($connection, $_POST['phone']);
        $pincode = mysqli_real_escape_string($connection, $_POST['pincode']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($connection, $_POST['payment_mode']);
        // $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
        if ($payment_id === null) {
            $payment_id = "null"; // เปลี่ยนเป็นสตริงที่ถูกต้อง
        } else {
            $payment_id = mysqli_real_escape_string($connection, $_POST['payment_id']);
        }
        

        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "")
        {
            $_SESSION['message'] = "คุณกรอกข้อมูลไม่ครบถ้วน";
            header('Location: ../checkout.php');
            exit(0);
        } 

        $userId = $_SESSION['auth_user']['id'];

        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.price 
            FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC  ";

        $query_run = mysqli_query($connection, $query);

        //รับผลรวมข้องราคาสินค้า
        $totalPrice = 0;
        foreach ($query_run as $citem) 
        {
            $totalPrice += $citem['price'] * $citem['prod_qty'];
        }

       //เพิ่มข้อมูลเข้าไปใน ออเดอร์
        $tracking_no = "Somtuy".rand(1111,9999).substr($phone,2);
        $insert_query = "INSERT INTO orders (user_id, tracking_no, name, email, phone, address, pincode, total_price, payment_mode, payment_id ) VALUES ('$userId','$tracking_no', '$name', '$email', '$phone', '$address', '$pincode', '$totalPrice', '$payment_mode', '$payment_id') ";
        $insert_query_run = mysqli_query($connection, $insert_query);
       
        if($insert_query_run)
        {
            $order_id = mysqli_insert_id($connection);
            foreach ($query_run as $citem) 
            {
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['price'];

                $insert_items_qurty = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES 
                ('$order_id', '$prod_id', '$prod_qty', '$price') ";
                $insert_items_qurty_run = mysqli_query($connection, $insert_items_qurty);

                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1 ";
                $product_query_run = mysqli_query($connection, $product_query);

                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['num'];

                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = "UPDATE products SET num='$new_qty' WHERE id='$prod_id'";
                $updateQty_query_run = mysqli_query($connection, $updateQty_query);
            }

            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$userId'";
            $deleteCartQuery_run = mysqli_query($connection , $deleteCartQuery);

            $_SESSION['message'] = "สั่งซื้อสินค้าเรียบร้อยแล้ว";
            header('Location: ../my-orders.php');
            die();

        }
    }

}
else  {
    header('Location: ../index.php');
}

?>