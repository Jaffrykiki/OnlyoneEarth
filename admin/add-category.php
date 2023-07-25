<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="ป้อนชื่อหมวดหมู่" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" name="add_category_btn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php') ?>