<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('includes/navbar.php');

// ตรวจสอบว่ามีพารามิเตอร์ 'category' ถูกส่งมาทาง URL หรือไม่
if (isset($_GET['category'])) 
{
    $category_name = $_GET['category'];     // ดึงค่า 'category' จาก URL และเก็บในตัวแปร $category_name
    // เรียกใช้ฟังก์ชัน getNameActive() เพื่อดึงข้อมูลหมวดหมู่จากฐานข้อมูล
    $category_data = getNameActive("category", $category_name);
    $category = mysqli_fetch_array($category_data);

    // ตรวจสอบว่ามีข้อมูลหมวดหมู่ในตัวแปร $category หรือไม่
    if ($category) 
    {
        $cid = $category['id'];
        ?>
        <!-- เริ่มส่วนแสดงชื่อหมวดหมู่บนหน้าเว็บ -->
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
                    <?= $category['name']; ?> </h7>
                
            </div>
        </div>
         <!-- สิ้นสุดส่วนแสดงชื่อหมวดหมู่บนหน้าเว็บ -->


        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?= $category['name']; ?></h2>
                        <hr>
                        <div class="row">
                            <?php
                            // เรียกใช้ฟังก์ชัน getProdByCategory() เพื่อดึงข้อมูลสินค้าในหมวดหมู่นี้
                            $products = getProdByCategory($cid);

                            // เรียกใช้ฟังก์ชัน getProdByCategory() เพื่อดึงข้อมูลสินค้าในหมวดหมู่นี้
                            if (mysqli_num_rows($products) > 0) 
                            {
                                // วน loop แสดงข้อมูลสินค้า
                                foreach ($products as $item) {
                            ?>
                                    <!-- แสดงสินค้าแต่ละรายการ -->
                                    <div class="col-md-2 mb-2">
                                        <a href="product-view.php?product=<?= $item['name']; ?>">
                                            <div class="card shadow">
                                                <div class="card-body">
                                                    <div class="shadow">
                                                        <img src="uploads/<?= $item['image']; ?>" width="300px" height="180px" alt="Product image" class="w-100">
                                                        <h4 class="text-center"><?= $item['name']; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php
                                }
                            } 
                            else 
                            {
                                echo "ยังไม่มีสินค้าในหมวดหมู่นี้";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    } 
    else 
    {
        echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
    }
} 
else 
{
    echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
}
include('includes/footer.php'); ?>