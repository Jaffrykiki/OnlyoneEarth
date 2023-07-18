<?php
include("sidebar.php");
include("includes/header.php");
include('../funtion/myfuntion.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div class="card-body">
        <form action="code.php" method="POST" enctype="multipart/form-data">
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Add Product</h1>
                <div class="mb-3">
                    <label for="" class="form-label">หมวดหมู่สินค้า</label>
                    <select class="form-select" >
                        <?php 
                            $category = getAll("table_product_category");

                            if(mysqli_num_rows($category) > 0 )
                            {
                                foreach ($category as $item) {
                                    ?>
                                 <option value="<?=$item['Cat_id'];?>"><?=$item['Name']; ?></option>
                                 <?php
                                }
                            }
                            else 
                            {
                                echo"No category Avilable";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">ชื่อสินค้า</label>
                    <input type="text" name="name" class="form-control" placeholder="ป้อนชื่อหมวดหมู่ที่คุณต้องการสร้าง">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">รายละเอียดสินค้า</label>
                    <input type="text" name="name" class="form-control" placeholder="ป้อนรายละเอียดสินค้าที่คุณต้องการสร้าง">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">ราคา</label>
                    <input type="text" name="name" class="form-control" placeholder="ป้อนราคาสินค้าที่คุณต้องการสร้าง">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">จำนวน</label>
                    <input type="text" name="name" class="form-control" placeholder="ป้อนจำนวนสินค้าที่คุณต้องการสร้าง">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">รูปภาพสินค้า</label>
                    <input type="file" required name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-success" name="add_category_btn">Save</button>
        </form>
        </main>
    </div>


</body>

</html>


<?php include("includes/script.php"); ?>