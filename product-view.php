<?php

include('funtion/userfunction.php');
include('includes/header.php');

if (isset($_GET['product'])) {

    $product_name = $_GET['product'];
    $product_data = getNameActive("products", $product_name);
    $product = mysqli_fetch_array($product_data);


    if ($product) {
?>
        <div class="py-3 bg-primary">
            <div class="container">
                <h7 class="text-white">
                    <a class="text-white" href="categories.php">
                        หน้าแรก /
                    </a>
                    <a class="text-white" href="categories.php">
                        หมวดหมู่ /
                    </a>
                    <?= $product['name']; ?>
                </h7>
            </div>
        </div>

        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']; ?>" alt="Product Image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['name']; ?> 
                            <span class="float-end text-danger"><?php if($product['trending']){ echo "กำลังมาแรง";} ?></span>
                    </h4>
                        <hr>
                        <h6>รายละเอียดสินค้า:</h6>
                        <p> <?= $product['detail']; ?> </p>
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
                                <div class="input-group mb-3" style="width:140px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"><i class="fa fa-shopping-cart me-2"></i>เพิ่มสินค้าลงตระกร้า</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-warning px-4"><i class="fa fa-heart me-2"></i> เพิ่มลงในสิ่งที่อยากได้ของคุณ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "ไม่พบสินค้าที่คุณค้นหา";
    }
} else {
    echo "มีบางอย่างผิดพลาด ติดต่อแอดมินสมถุย";
}
include('includes/footer.php'); ?>