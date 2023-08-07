<?php

include('funtion/userfunction.php');
include('includes/header.php');

include('authenticate.php');

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
            <div class="card card-body shadow">
                <form action="funtion/placeorder.php" method="POST">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>ที่อยู่ในการจัดส่ง</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">ชื่อ</label>
                                    <input type="text" name="name" required placeholder="ป้อนชื่อของของคุณ" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">อีเมล์</label>
                                    <input type="email" name="email" required placeholder="ป้อนอีเมล์ของของคุณ" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">เบอร์โทรศัพท์</label>
                                    <input type="text" name="phone" required placeholder="ป้อนเบอร์โทรศัพท์ของของคุณ" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">รหัสไปรษณีย์</label>
                                    <input type="text" name="pincode" required placeholder="ป้อนรหัสไปรษณีย์" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">ที่อยู่</label>
                                    <textarea name="address" required placeholder="ป้อนที่อยู่ของของคุณ" class="form-control" rows="6"></textarea>
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
                            <?php $items = getCartItems();
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
                                $totalPrice += $citem['price'] * $citem['prod_qty'];
                            }
                            ?>
                            <hr>
                            <h5>ราคารวม : <span class="float-end fw-bold"><?= $totalPrice ?></span></h5>
                            <div class="">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">สั่งซื้อสินค้า</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>




<?php include('includes/footer.php'); ?>