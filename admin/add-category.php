<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');


?>



<!-- เริ่มต้นส่วนของเนื้อหา -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>เพิ่มหมวดหมู่สินค้า
                </h4>
                </div>
                <div class="card-body">
                     <!-- แบบฟอร์มสำหรับเพิ่มหมวดหมู่ -->
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="">ชื่อหมวดหมู่</label>
                                <!-- ช่องใส่ข้อมูลชื่อหมวดหมู่ -->
                                <input type="text" name="name" placeholder="ป้อนชื่อหมวดหมู่" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- ปุ่มสำหรับบันทึกข้อมูล -->
                            <button type="submit" class="btn btn-primary" name="add_category_btn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- จบส่วนของเนื้อหา -->



<?php include('includes/footer.php') ?>