<?php

include('funtion/userfunction.php');
include('includes/header.php');
// include('includes/navbar.php');

include('authenticate.php'); // เรียกใช้ไฟล์ authenticate.php ที่เป็นการตรวจสอบสิทธิ์การเข้าถึงหน้านี้

?>

<div class="py-3 bg-primary">
    <div class="container">
        <h7 class="text-white">
            <a href="index.php" class="text-white">
                หน้าแรก /
            </a>
            <a href="cart.php" class="text-white">
                รถเข็น
            </a>
        </h7>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <div id="mycart">
                        <?php
                        $items = getCartItems(); // ดึงรายการสินค้าในตะกร้าของผู้ใช้
                        if (mysqli_num_rows($items) > 0) 
                        {
                        ?>
                            <div class="row align-items-center">
                                <!-- แสดงส่วนหัวของตารางรายการสินค้าในตะกร้า -->
                                <div class="col-md-5">
                                    <h6>สินค้า</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>ราคา</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>จำนวนสินค้า</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>แอคชั่น</h6>
                                </div>
                            </div>
                            <div id="">
                                <?php
                                foreach ($items as $citem) { // ใช้ loop วนเพื่อแสดงข้อมูลของสินค้าในตะกร้า
                                ?>
                                    <div class="card product_data shadow-sm mb-3">
                                        <!-- แสดงรายการสินค้าแต่ละรายการในตะกร้า -->
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?= $citem['image_filename']; ?>" alt="Image" width="160" height="160" >
                                            </div>
                                            <div class="col-md-3">
                                                <h5><?= $citem['name']; ?></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>฿<?= $citem['price']; ?></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                                <div class="input-group mb-3" style="width:140px">
                                                    <button class="input-group-text decrement-btn updateQty">-</button>
                                                    <input type="text" class="form-control text-center input-qty bg-white" value="<?= $citem['prod_qty']; ?>" disabled>
                                                    <button class="input-group-text increment-btn updateQty">+</button>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger deleteItem" value="<?= $citem['cid'] ?>">
                                                    <i class="fa fa-trash me-2" aria-hidden="true"></i>ลบ</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="float-end">
                                <a href="checkout.php" class="btn btn-outline-success">สั่งซื้อสินค้า</a>
                            </div>
                        <?php
                        } 
                        else 
                        {
                        ?>
                            <div class="card card-body shadow text-center">
                                <h4 class="py3">ตระกร้าสินค้าของคุณว่างเปล่า</h4>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>