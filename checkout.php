<?php

include('funtion/userfunction.php');
include('includes/header.php');

include('authenticate.php');

$cartItems = getCartItems(); // ดึงข้อมูลสินค้าในตะกร้าสินค้า

if(mysqli_num_rows($cartItems) ==0 )
{
    header('Location: index.php'); // ถ้าไม่มีสินค้าในตะกร้า ให้เปลี่ยนเส้นทางไปยังหน้า index.php
}

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h7 class="text-white">
            <a href="index.php" class="text-white">
                หน้าแรก /
            </a>
            <a href="checkout.php" class="text-white">
                ทำการสั่งซื้อ
            </a>
        </h7>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href="cart.php" class="btn btn-warning float-end">กลับ</a>
            </div>
            <div class="card card-body shadow">
                <form action="funtion/placeorder.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>ที่อยู่ในการจัดส่ง</h5>
                            <hr>
                             <!-- ส่วนของการป้อนข้อมูลที่อยู่ในการจัดส่ง -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">ชื่อ</label>
                                    <input type="text" name="name" id="name" required placeholder="ป้อนชื่อของของคุณ" class="form-control">
                                    <smail class="text-danger name"></smail>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">อีเมล์</label>
                                    <input type="email" name="email" id="email" required placeholder="ป้อนอีเมล์ของของคุณ" class="form-control">
                                    <smail class="text-danger email"></smail>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">เบอร์โทรศัพท์</label>
                                    <input type="text" name="phone" id="phone" required placeholder="ป้อนเบอร์โทรศัพท์ของของคุณ" class="form-control">
                                    <smail class="text-danger phone"></smail>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">รหัสไปรษณีย์</label>
                                    <input type="text" name="pincode" id="pincode" required placeholder="ป้อนรหัสไปรษณีย์" class="form-control">
                                    <smail class="text-danger pincode"></smail>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">ที่อยู่</label>
                                    <textarea name="address" id="address" required placeholder="ป้อนที่อยู่ของของคุณ" class="form-control" rows="6"></textarea>
                                    <smail class="text-danger address"></smail>
                                </div>
                                <!-- <div class="col-md-12 mb-">
                                    <label class="mb-0">อัปโหลดหลักฐานการชำระเงิน</label>
                                    <input type="file" required name="image" class="form-control mb-2">
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>รายละเอียดการสั่งซื้อ</h5>
                            <hr>
                            <!-- ส่วนของการแสดงรายละเอียดการสั่งซื้อ -->
                            <?php 
                            $items = getCartItems(); // ดึงข้อมูลสินค้าในตะกร้าสินค้า
                            $totalPrice = 0;
                            foreach ($items as $citem) {
                            ?>
                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="uploads/<?= $citem['image']; ?>" alt="Image" width="80px">
                                        </div>
                                        <div class="col-md-5">
                                            <label><?= $citem['name']; ?></label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>฿<?= $citem['price']; ?></label>
                                        </div>
                                        <div class="col-md-2">
                                            <label>x<?= $citem['prod_qty']; ?></label>
                                        </div>
                                    </div>
                                </div>
                             
                            <?php
                                    //แสดงรายละเอียดของสินค้าที่เลือกในตะกร้า 
                                $totalPrice += $citem['price'] * $citem['prod_qty'];
                            }
                            ?>
                            <hr>
                            <h5>ราคารวม : <span class="float-end fw-bold"><?= $totalPrice ?></span></h5>
                            <div class="">
                                <input type="hidden" name="payment_mode" value="COD"> <!-- ตั้งค่าวิธีการชำระเงินเป็น COD (Cash on Delivery) -->
                                <button type="submit" name="placeOrderBtn" class="btn btn-success w-100">สั่งซื้อสินค้า | ชำระเงินปลายทาง</button>
                                <!-- กำหนดส่วนที่จะแสดงปุ่ม PayPal -->
                                <div id="paypal-button-container" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>

<!-- โหลดสคริปต์ของ PayPal SDK โดยใช้ client-id ของบัญชีธุรกิจ PayPal และสกุลเงิน USD -->
<script src="https://www.paypal.com/sdk/js?client-id=AbFdqnQlPD3JEvVi1AM-SMgpmgwa9IFVZ_dLnFS8KrPqZWuaBfk5DnqVoGn9uONFhztlTUrqIg75U-pF&currency=USD"></script>

<script>
    // สร้างปุ่ม PayPal Checkout
    paypal.Buttons({
        // การตรวจสอบข้อมูลก่อนการกดปุ่ม PayPal
        onClick() {     
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var pincode = $('#pincode').val();
            var address = $('#address').val();

            if (name.length == 0) {
                $('.name').text("*กรุณากรอกชื่อให้ครบถ้วน");
            } else {
                $('.name').text("");
            }
            if (email.length == 0) {
                $('.email').text("*กรุณากรอกอีเมล์ให้ครบถ้วน");
            } else {
                $('.email').text("");
            }
            if (phone.length == 0) {
                $('.phone').text("*กรุณากรอกเบอร์โทรศัพท์ให้ครบถ้วน");
            } else {
                $('.phone').text("");
            }
            if (pincode.length == 0) {
                $('.pincode').text("*กรุณากรอกรหัสไปษณีย์ให้ครบถ้วน");
            } else {
                $('.pincode').text("");
            }
            if (address.length == 0) {
                $('.address').text("*กรุณากรอกที่อยู่ให้ครบถ้วน");
            } else {
                $('.address').text("");
            }

            if (name.length == 0 || email.length == 0 || phone.length == 0 || pincode.length == 0 || address.length == 0) {
                return false;
            }

        },
        // ส่วนการสร้างคำสั่งการชำระเงิน PayPal
        createOrder: function(data, actions) { 

            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $totalPrice ?>'
                    }
                }]
            });
        },
        // ส่วนการจัดการเมื่อชำระเงิน PayPal เสร็จสิ้น
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                const transaction = orderData.purchase_units[0].payments.captures[0];

                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var pincode = $('#pincode').val();
                var address = $('#address').val();

                var data = {
                    'name' : name,
                    'email' : email,
                    'phone' : phone,
                    'pincode' :pincode,
                    'address' : address,
                    'payment_mode' : "จ่ายโดย PayPal",
                    'payment_id' : transaction.id,
                    'placeOrderBtn': true
                };

                $.ajax({
                    type: "POST",
                    url: "funtion/placeorder.php",
                    data: data,
                    success: function (response) {
                        if(response == 201)
                        {
                            alertify.success("สั่งซื้อเรียบร้อยแล้ว");
                            window.location.href = 'my-orders.php'
                        }
                    }
                });
            });
        }
    }).render('#paypal-button-container'); // แสดงปุ่ม PayPal Checkout ในส่วนนี้
</script>