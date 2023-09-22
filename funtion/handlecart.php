<?php

session_start();
include('../connection/dbcon.php');



if (isset($_SESSION['auth']))  // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
{
    if (isset($_POST['scope'])) {
        $scope  = $_POST['scope']; // รับค่า scope ที่ส่งมาเพื่อตรวจสอบการดำเนินการที่จะทำ
        switch ($scope) {
            case "add": // กรณีเพิ่มสินค้าลงในตระกร้า
                $prod_id = $_POST['prod_id']; // รับค่า id ของสินค้า
                $prod_qty = $_POST['prod_qty']; // รับค่าจำนวนสินค้าที่จะเพิ่ม

                // เช็คว่าสินค้านี้มีอยู่ในตระกร้าของผู้ใช้หรือไม่
                $user_id = $_SESSION['auth_user']['id'];

                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $chk_existing_cart_run = mysqli_query($connection, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    echo "existing"; // สินค้ามีอยู่ในตระกร้าแล้ว
                } else {
                    // ตรวจสอบว่าสินค้ามีจำนวนพอหรือไม่
                    $check_product_quantity = "SELECT num FROM products WHERE id='$prod_id'";
                    $check_product_quantity_run = mysqli_query($connection, $check_product_quantity);

                    if ($check_product_quantity_run) {
                        $row = mysqli_fetch_assoc($check_product_quantity_run);
                        $product_quantity = $row['num'];

                        if ($product_quantity >= $prod_qty) {
                            $insert_query =  "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ('$user_id','$prod_id','$prod_qty') ";
                            $insert_query_run = mysqli_query($connection, $insert_query);

                            if ($insert_query_run) {
                                echo 201; // เพิ่มสินค้าลงในตระกร้าสำเร็จ
                            } else {
                                echo 500; // เกิดข้อผิดพลาดในการเพิ่มสินค้า
                            }
                        } else {
                            echo 600; // สินค้ามีจำนวนไม่พอ
                        }
                    } else {
                        echo 500; // เกิดข้อผิดพลาดในการตรวจสอบจำนวนสินค้า
                    }
                }
                break;


            case "update": // กรณีอัปเดตจำนวนสินค้าในตระกร้า
                $prod_id = $_POST['prod_id']; // รับค่า id ของสินค้า
                $prod_qty = $_POST['prod_qty']; // รับค่าจำนวนสินค้าที่ต้องการอัปเดต

                // เช็คว่าสินค้านี้มีอยู่ในตระกร้าของผู้ใช้หรือไม่
                $user_id = $_SESSION['auth_user']['id'];

                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $chk_existing_cart_run = mysqli_query($connection, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";

                    $update_query_run = mysqli_query($connection, $update_query);
                    if ($update_query_run) {
                        echo 200; // อัปเดตจำนวนสินค้าในตระกร้าสำเร็จ
                    } else {
                        echo 500; // เกิดข้อผิดพลาดในการอัปเดต
                    }
                } else {
                    echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
                }
                break;

                //ลบสินค้าในตระกร้า
            case "delete": // กรณีลบสินค้าในตระกร้า
                $cart_id = $_POST['cart_id']; // รับค่า id ของรายการสินค้าในตระกร้า

                // เช็คว่ารายการสินค้านี้อยู่ในตระกร้าของผู้ใช้หรือไม่
                $user_id = $_SESSION['auth_user']['id'];


                $chk_existing_cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id' ";
                $chk_existing_cart_run = mysqli_query($connection, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    $delete_query = "DELETE FROM carts WHERE id='$cart_id' ";
                    $delete_query_run = mysqli_query($connection, $delete_query);
                    if ($delete_query_run) {
                        echo 200; // ลบรายการสินค้าในตระกร้าสำเร็จ
                    } else {
                        echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
                    }
                } else {
                    echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
                }
                break;

            default:
                echo 500; // ค่า scope ไม่ถูกต้อง
        }
    }
} else {
    echo 401; // ผู้ใช้ไม่ได้เข้าสู่ระบบ
}
