<?php
include('funtion/userfunction.php');
include('includes/header.php');


?>

<div class="py-3 bg-primary">
    <div class="container">
        <h7 class="text-white">หน้าแรก / หมวดหมู่ </h7>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>หมวดหมู่</h1>
                <hr>
                <div class="row">
                    <?php
                    $caregories = getAllActive("category");
                    if (mysqli_num_rows($caregories) > 0) {
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