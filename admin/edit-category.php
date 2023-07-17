<?php
$page_title = "Edit Category";
include("sidebar.php");
include("includes/header.php");
include('../funtion/myfuntion.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="card-body">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $category =  getByID("table_product_category", $id);

            if (mysqli_num_rows($category) > 0) 
            {
                $date = mysqli_fetch_array($category);

        ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">
                    <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                        <h1 class="h2">Edit Category</h1>
                        <div class="mb-3">
                            <input type="hidden" name="category_id" value="<?= $date['Cat_id']  ?>">
                            <label for="" class="form-label">ชื่อหมวดหมู่</label>
                            <input type="text" name="name" value="<?= $date['Name']  ?>" class="form-control" placeholder="ป้อนชื่อหมวดหมู่ที่คุณต้องการสร้าง">
                        </div>
                        <button type="submit" class="btn btn-success" name="update_category_btn">Update</button>
                </form>
                </main>
        <?php
            } else {
                echo "Category not found";
            }
        } else {
            echo "Id Missing from url ";
        }
        ?>
    </div>


</body>

</html>


<?php include("includes/script.php"); ?>