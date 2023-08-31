<?php
include('funtion/userfunction.php');
include('includes/header.php');
include('includes/navbar.php');


?>

<div class="py-3 bg-primary">
    <div class="container">
        <h7 class="text-white">
            <a href="index.php" class="text-white">
                หน้าแรก /
            </a>
            <a href="categories.php" class="text-white">
                หมวดหมู่
            </a>
        </h7>
    </div>
</div>

<div class="py-5">
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                
                <div class="d-flex justify-content-between align-items-center"> <!-- ใช้ flexbox เพื่อจัดตำแหน่งทางซ้ายและขวา -->
                <!-- ช่องสำหรับการจัดวางองค์ประกอบด้านซ้ายและขวา -->
                    <h1 class="m-0">หมวดหมู่</h1> <!-- ใช้ margin 0 เพื่อลบระยะห่างด้านบนและล่างของหัวเรื่อง -->
                    <form class="d-flex m-0" role="search" style="max-width: 300px;">
                        <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                
                <hr>
                <div class="row">
                    
                    <?php
                    $caregories = getAllActive("category"); // ดึงข้อมูลหมวดหมู่ทั้งหมด
                    if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                        $searchTerm = $_GET['searchTerm'];
                        // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                        $categorys = searchCategories($searchTerm);
                        if (!empty($categorys)) {
                            foreach ($categorys as $category) {
                    ?>
                                <div class="col-md-2 mb-3">
                                    <a href="products.php?category=<?= $category['name'] ?>">
                                        <div class="btn btn-primary shadow">
                                            <h4 class="text-center"></h4><?= $category['name'] ?> </h4>
                                        </div>
                                    </a>
                                </div>
                            <?php
                            }
                        } else if (empty($categorys)) {
                            echo "ค้นหาหมวดหมู่สินค้าไม่เจอ";
                        }
                    } else  if (mysqli_num_rows($caregories) > 0) {
                        // วน loop แสดงข้อมูลสินค้า
                        foreach ($caregories as $item) {
                            ?>

                            <div class="col-md-2 mb-3">
                                <a href="products.php?category=<?= $item['name'] ?>">
                                    <div class="btn btn-primary shadow">
                                        <h4 class="text-center"></h4><?= $item['name'] ?> </h4>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "ยังไม่มีหมวดหมู่สินค้า";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>