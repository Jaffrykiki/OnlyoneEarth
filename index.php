<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('includes/navbar.php');
include('includes/slider.php');
include('connection/dbcon.php');

// โค้ด query จำนวนรายการสินค้าทั้งหมด
$query = mysqli_query($connection, "SELECT COUNT(id) FROM `products`");
$row = mysqli_fetch_row($query);

$rows = $row[0];

$page_rows = 8;  // จำนวนข้อมูลที่ต้องการแสดงใน 1 หน้า

$last = ceil($rows / $page_rows);

if ($last < 1) {
    $last = 1;
}

$pagenum = 1;

if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}

if ($pagenum < 1) {
    $pagenum = 1;
} else if ($pagenum > $last) {
    $pagenum = $last;
}

$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

// โค้ด query รายการสินค้าที่แบ่งหน้า
$query = "
        SELECT p.id, p.category_id, p.users_id, p.name, p.detail, p.price,p.num, p.trending, p.created_at, pi.image_filename
        FROM products p
        LEFT JOIN (
            SELECT product_id, MIN(image_filename) as image_filename
            FROM product_images
            GROUP BY product_id
        ) pi ON p.id = pi.product_id
        $limit
    ";

$nquery = mysqli_query($connection, $query);

$paginationCtrls = '';


// โค้ดสร้างลิงก์เปลี่ยนหน้า
if ($last != 1) {

    if ($pagenum > 1) {
        $previous = $pagenum - 1;
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '#og" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

        for ($i = $pagenum - 4; $i < $pagenum; $i++) {
            if ($i > 0) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '#og" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                // $paginationCtrls .= '<a href="#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
            }
        }
    }

    $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

    for ($i = $pagenum + 1; $i <= $last; $i++) {
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '#og" class="btn btn-primary">' . $i . '</a> &nbsp; ';
        if ($i >= $pagenum + 4) {
            break;
        }
    }

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $next . '#og" class="btn btn-info">Next</a> ';
    }
}
?>
<!-- เริ่มต้นส่วนของการแสดงสินค้าที่กำลังมาแรง -->
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>สินค้าที่กำลังมาแรง</h1>
                <div class="underline mb-2"></div>
                <div class="owl-carousel">
                    <?php
                    // ดึงข้อมูลสินค้าที่กำลังมาแรงและแสดงผล
                    $trendingProducts = getAllTrending();
                    if (mysqli_num_rows($trendingProducts) > 0) {
                        foreach ($trendingProducts as $item) {
                    ?>
                            <div class="item">
                                <a href="product-view.php?product=<?= $item['name']; ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="shadow">
                                                <img src="uploads/<?= $item['image_filename']; ?>" width="300" height="300" alt="Product image" class="w-100">
                                                <h5 class="text-center"><?= $item['name']; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนของการแสดงสินค้าทั่วไป -->
<div id="og" class="py-5">
    <div class="container">
        <div class="row">
            <!-- ตั้งค่าการจัดตำแหน่งและจัดกลุ่มแสดงผล -->
            <div class="d-flex justify-content-between align-items-center"> <!-- ใช้ flexbox เพื่อจัดตำแหน่งทางซ้ายและขวา -->
                <h1 class="m-0">สินค้าทั่วไป</h1> <!-- ใช้ margin 0 เพื่อลบระยะห่างด้านบนและล่างของหัวเรื่อง -->
                <!-- ฟอร์มค้นหาสินค้า -->
                <form class="d-flex m-0" role="search" style="max-width: 300px;">
                    <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <!-- แสดงรายการสินค้าทั่วไป -->
            <div class="row row-cols-1 row-cols-md-4 ">
                <?php
                // ดึงข้อมูลสินค้าทั้งหมด
                $Products = getAllProducts();
                if (mysqli_num_rows($Products) > 0)
                    foreach ($Products as $item)
                ?>
                <?php
        $Products = getAllProducts("products");
        // ถ้ามีการกำหนดค่า searchTerm และไม่ว่างเปล่า
        if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
            $searchTerm = $_GET['searchTerm'];
            // ดึงข้อมูลสินค้าจากคำค้นหา
            $products = searchProducts($searchTerm);
            // ถ้าพบผลลัพธ์จากการค้นหา
            if (!empty($products)) {
                foreach ($products as $product) {
                ?>
                            <div class="col">
                                <div class="item">
                                    <a href="product-view.php?product=<?= $product['name']; ?>">
                                        <div class="card shadow" style="margin-bottom: 20px;">
                                            <img src="uploads/<?= $product['image_filename']; ?>" width="300" height="300" alt="Product image" class="w-100">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $product['name']; ?></h5>
                                            </div>
                                        </div>
                                </div>
                                </a>
                            </div>
                        <?php
                    }
                } else if (empty($products)) {
                    echo "ค้นหาสินค้าไม่เจอ";
                }
            } else  if ($nquery && mysqli_num_rows($nquery) > 0) {
                while ($item = mysqli_fetch_assoc($nquery)) {
                        ?>
                        <div class="col">
                            <div class="item">
                                <a href="product-view.php?product=<?= $item['name']; ?>">
                                    <div class="card shadow" style="margin-bottom: 20px;">
                                        <div class="card-body">
                                            <div class="shadow" style="margin-bottom: 20px;">
                                                <img src="uploads/<?= $item['image_filename']; ?>" width="300" height="300" alt="Product image" class="w-100">
                                                <h5 class="card-title"><?= $item['name']; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </a>
                        </div>
                <?php
                }
            } else {
                echo "ยังไม่มีสินค้า";
            }
                ?>
                <br>
            </div>
            <!-- แสดงปุ่มเปลี่ยนหน้า -->
            <div id="about-me" id="pagination_controls"><?php echo $paginationCtrls; ?></div>
        </div>
    </div>
</div>

<!-- ส่วนของเกี่ยวกับฉัน -->
<div class="py-5 bg-f2f2f2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>เกี่ยวกับฉัน</h4>
                <div class="underline mb-2"></div>
                <p>
                    ยินดีต้อนรับสู่ OnlyOneEarth ชุมชนการซื้อขายสินค้าสิ่งแวดล้อมและสินค้ารักษโลกออนไลน์ที่คัดสรรมาอย่างดีที่สุดในประเทศไทย! เราเกิดขึ้นจากความห่วงใยต่อสิ่งแวดล้อมและความคุ้มครองของโลกของเรา คือพื้นที่ที่ผู้ที่มองหาสินค้าที่ดีต่อสิ่งแวดล้อมและชุมชนของคนรักษ์โลกสามารถมาร่วมกันซื้อขายและสนับสนุนกันได้.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- ส่วนท้ายเว็บ -->
<div class="py-2 bg-danger">
    <div class="text-center">
        <div class="p-md-0 text-white">All rights reserved. Copyright @ <a href="https://www.facebook.com/autsadawut.plaglamyong/" target="_blank" class="text-white">Jaffry zavier</a> <?= date('Y') ?></div>
    </div>
</div>



<?php include('includes/footer.php'); ?>

<!-- สคริปต์และการใช้งาน Owl Carousel -->
<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    });

    document.addEventListener("DOMContentLoaded", function() {
        var titleElements = document.querySelectorAll(".card-title");
        var maxTitleLength = 15; // จำนวนสูงสุดของตัวอักษรที่คุณต้องการแสดง

        titleElements.forEach(function(titleElement) {
            var titleText = titleElement.innerText;
            if (titleText.length > maxTitleLength) {
                titleElement.innerText = titleText.slice(0, maxTitleLength) + "...";
            }
        });
    });
</script>