<?php 
include("sidebar.php");  
include("includes/header.php");
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
                <h1 class="h2">Add Category</h1>
                <div class="mb-3">
                    <label for="" class="form-label">ชื่อหมวดหมู่</label>
                    <input type="text" name="name" class="form-control" placeholder="ป้อนชื่อหมวดหมู่ที่คุณต้องการสร้าง">
                </div>
                <button type="submit" class="btn btn-success" name="add_category_btn">Save</button>
        </form>
        </main>
    </div>
 

</body>
</html>


<?php include("includes/script.php");?>

