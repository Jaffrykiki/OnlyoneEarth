<?php

include('funtion/userfunction.php');
include('includes/header.php');

if (isset($_GET['category'])) 
{
    $category_name = $_GET['category'];
    $category_data = getNameActive("category", $category_name);
    $category = mysqli_fetch_array($category_data);

    if ($category) 
    {
        $cid = $category['id'];
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
                    <?= $category['name']; ?> </h7>
                
            </div>
        </div>

        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?= $category['name']; ?></h2>
                        <hr>
                        <div class="row">
                            <?php

                            $products = getProdByCategory($cid);

                            if (mysqli_num_rows($products) > 0) 
                            {

                                foreach ($products as $item) {
                            ?>
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