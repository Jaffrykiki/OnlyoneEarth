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
        // เพิ่มส่วนการดึงข้อมูลรูปภาพจากตาราง product_images
        $product_id = $product['id'];
        $image_query = "SELECT image_filename FROM product_images WHERE product_id = $product_id";
        $image_result = mysqli_query($connection, $image_query);
        $image_row = mysqli_fetch_assoc($image_result);

        $image_filename = $image_row['image_filename'];
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
                        <!-- เริ่มลูป while เพื่อเก็บรายการรูปภาพทั้งหมดในอาร์เรย์ -->
                        <?php
                        $image_filenames = array();
                        while ($image_row = mysqli_fetch_assoc($image_result)) {
                            $image_filenames[] = $image_row['image_filename'];
                        }
                        ?>
                        <!-- แสดงรูปภาพแรก -->
                        <div class="product-image-container">
                            <img src="uploads/<?= $image_filenames[0]; ?>" alt="Product Image" class="product-image" id="productImage" onclick="openLightbox('uploads/<?= $image_filenames[0]; ?>', 0)">
                        </div>
                        <div class="image-container">
                            <!-- แสดงรูปภาพอื่นๆ -->
                            <?php for ($i = 1; $i < count($image_filenames); $i++) { ?>
                                <div class="product-image-container">
                                    <img src="uploads/<?= $image_filenames[$i]; ?>" alt="Product Image" class="product-image" id="productImage" onclick="openLightbox('uploads/<?= $image_filenames[$i]; ?>', <?= $i; ?>)">
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- HTML สำหรับปุ่มปิดใน Lightbox Image -->
                    <div id="lightbox" class="lightbox">
                        <span class="close-button" onclick="closeLightbox()">&times;</span>
                        <img src="" id="lightbox-image" class="lightbox-content">
                        <button id="prev-button" onclick="prevImage()">
                            <i class="fa fa-arrow-left" aria-hidden="true" style="font-size: 40px;"></i>
                        </button>
                        <button id="next-button" onclick="nextImage()">
                            <i class="fa fa-arrow-right" aria-hidden="true" style="font-size: 40px;"></i>
                        </button>
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
                        <p style="line-height: 1.6; font-size: 22px; white-space: pre-line;"><?= $product['detail']; ?></p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>ราคา:<span class="text-success fw-bold"> ฿<?= $product['price']; ?></span> </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>ชื่อผู้ขาย:<span class="text-success fw-bold"><?= $product['seller_name']; ?></span> </h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>รหัสผู้ขาย:<span class="text-success fw-bold"><?= $product['users_id']; ?></span> </h5>
                            </div>
                        </div>


                        <!-- ปุ่มเพิ่ม/ลดจำนวนสินค้าในตะกร้า -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width:140px">
                                    <span class="input-group-text">จำนวนสินค้า</span>
                                    <button class="input-group-text decrement-btn" style="margin-top: 10px;">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" style="margin-top: 10px;" value="1" disabled>
                                    <button class="input-group-text increment-btn" style="margin-top: 10px;">+</button>
                                    <span style="margin-top: 10px;">มีสินค้าทั้งหมด <?= $product['num']; ?> ชิ้น</span>
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
                                    <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>เพิ่มสินค้าลงตระกร้า</button>
                                <?php
                                } else {
                                    echo "<p class='text-danger'>สินค้าหมดชั่วคราว</p>";
                                }
                                ?>
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

<!-- ส่วน JavaScript เปลี่ยนรูปภาพ-->


<script>
    // JavaScript สำหรับเปิดและปิด Lightbox Image
    var lightbox = document.getElementById("lightbox");
    var lightboxImage = document.getElementById("lightbox-image");

    // เพิ่มตัวแปรสำหรับการเก็บรหัสรูปภาพที่ถูกคลิก
    var currentImageIndex = 0;

    function openLightbox(imageSrc, imageIndex) {
        lightboxImage.src = imageSrc;
        lightbox.style.display = "block";

        // อัปเดตตัวแปร currentImageIndex เมื่อรูปถูกคลิก
        currentImageIndex = imageIndex;
    }

    function closeLightbox() {
        lightbox.style.display = "none";
    }

    var images = [
        <?php foreach ($image_filenames as $filename) { ?> "uploads/<?= $filename; ?>",
        <?php } ?>
    ];
    var currentIndex = 0;
    var lightboxImage = document.getElementById("lightbox-image");

    // แก้ไขฟังก์ชัน prevImage() และ nextImage() เพื่อใช้ currentImageIndex
    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        showImage(currentImageIndex);
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        showImage(currentImageIndex);
    }

    function showImage(index) {
        lightboxImage.src = images[index];
    }

    // // เรียกใช้ฟังก์ชันแสดงรูปภาพแรก
    // showImage(currentIndex);

    // ฟังก์ชันตรวจสอบการกดปุ่ม ESC
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            closeLightbox(); // เรียกฟังก์ชันปิด Lightbox เมื่อกดปุ่ม ESC
        }
    });

    function closeLightbox() {
        var lightbox = document.getElementById("lightbox");
        lightbox.style.display = "none";

        // เพิ่มเช็คว่า lightbox ถูกปิดด้วยการกดปุ่ม ESC
        document.removeEventListener("keydown", function(event) {
            if (event.key === "Escape") {
                closeLightbox(); // เรียกฟังก์ชันปิด Lightbox เมื่อกดปุ่ม ESC
            }
        });
    }
</script>