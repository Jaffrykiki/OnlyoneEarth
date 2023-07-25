<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $category =  getByID("category", $id);

                if (mysqli_num_rows($category) > 0) {
                    $date = mysqli_fetch_array($category);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Category
                                <a href="category.php" class="btn btn-primary float-end">กลับ</a>
                            </h4>
                            </h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <input type="hidden" name="category_id" value="<?= $date['id']  ?>">
                                        <label for="">Name</label>
                                        <input type="text" name="name" value="<?= $date['name']  ?>" placeholder="ป้อนชื่อหมวดหมู่" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="update_category_btn">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "ไม่พบหมวดหมู่";
                }
            } else {
                echo "รหัสหายไปจาก url";
            }
            ?>
        </div>
    </div>
</div>




<?php include('includes/footer.php') ?>