<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('includes/navbar.php');

// ตรวจสอบว่ามีพารามิเตอร์ 'product' ถูกส่งมาทาง URL หรือไม่
if (isset($_GET['product'])) {


    $product_name = $_GET['product']; // ดึงค่า 'product' จาก URL และเก็บในตัวแปร $product_name
    $product_data = getNameActive("products", $product_name); // เรียกใช้ฟังก์ชัน getNameActive() เพื่อดึงข้อมูลสินค้าจากฐานข้อมูล
    $product = mysqli_fetch_array($product_data);

    // ตรวจสอบว่ามีข้อมูลสินค้าในตัวแปร $product หรือไม่
    if ($product) {
?>
        <!-- เริ่มส่วนแสดงข้อมูลสินค้าบนหน้าเว็บ -->
        <div class="py-3 bg-primary">
            <div class="container">
                <h7 class="text-white">
                    <!-- ลิงก์กลับไปที่หน้าแรก -->
                    <a class="text-white" href="categories.php">
                        หน้าแรก /
                    </a>
                    <!-- ลิงก์กลับไปที่หมวดหมู่สินค้า -->
                    <a class="text-white" href="categories.php">
                        หมวดหมู่ /
                    </a>
                    <?= $product['name']; ?> <!-- แสดงชื่อสินค้า -->
                </h7>
            </div>
        </div>

        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <!-- แสดงรูปภาพสินค้า -->
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['name']; ?>
                            <!-- แสดงข้อความ 'กำลังมาแรง' ถ้าสินค้ามีค่า trending เป็นจริง -->
                            <span class="float-end text-danger"><?php if ($product['trending']) {
                                                                    echo "กำลังมาแรง";
                                                                } ?></span>
                        </h4>
                        <hr>
                        <h6>รายละเอียดสินค้า:</h6>
                        <p style="line-height: 1.6; font-size: 22px;"> <?= $product['detail']; ?> </p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>ราคา:<span class="text-success fw-bold"> ฿<?= $product['price']; ?></span> </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>รหัสผู้ขาย:<span class="text-success fw-bold"><?= $product['users_id']; ?></span> </h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <!-- ปุ่มเพิ่ม/ลดจำนวนสินค้าในตะกร้า -->
                                <div class="input-group mb-3" style="width:140px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <?php
                                // เช็คจำนวนสินค้า ถ้าไม่เท่ากับ 0 แสดงปุ่มเพิ่มสินค้าลงตระกร้า
                                if ($product['num'] > 0) {
                                ?>
                                    <!-- ปุ่มเพิ่มสินค้าลงตะกร้า -->
                                    <button class="btn btn-primary px-4 addToCartBtn"  value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>เพิ่มสินค้าลงตระกร้า</button>
                                <?php
                                } else {
                                    echo "<p class='text-danger'>สินค้าหมดชั่วคราว</p>";
                                }
                                ?>
                            </div>
                            <div class="col-md-6">
                                <!-- ปุ่มเพิ่มสินค้าในสิ่งที่อยากได้ -->
                                <button class="btn btn-warning px-4"><i class="fa fa-heart me-2"></i> เพิ่มลงในสิ่งที่อยากได้ของคุณ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- สิ้นสุดส่วนแสดงข้อมูลสินค้าบนหน้าเว็บ -->
<?php
    } else {
        echo "ไม่พบสินค้าที่คุณค้นหา";
    }
} else {
    echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
}
include('includes/footer.php'); ?>