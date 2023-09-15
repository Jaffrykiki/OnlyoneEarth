<?php

include('funtion/userfunction.php');
include('includes/header.php');
// include('includes/navbar.php');
include('authenticate.php');



?>

<!-- เริ่มส่วนแสดงข้อมูลของผู้ใช้ -->
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card card-body shadow">
                <!-- เริ่มฟอร์มสำหรับการแก้ไขข้อมูลผู้ใช้ -->
                <form action="funtion/authcode.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-8">
                            <?php
                            // วน loop แสดงข้อมูลผู้ใช้ที่ได้รับมา 
                            $items = getUsers();
                            foreach ($items as $data) {
                            ?>
                                <h5 class="fw-bold">เรื่องที่คุณต้องการติดต่อ</h5>
                                <h8>อธิบายปัญหาของคุณ</h8>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">ไอดีผู้ใช้</label>
                                        <!-- แสดงไอดีผู้ใช้ที่ไม่สามารถแก้ไขได้ -->
                                        <input disabled type="text" name="id" value="<?= $data['id']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">เรื่อง</label>
                                        <!-- แสดงชื่อผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="text" id="subject" required name="subject" value="" required class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="fw-bold">รายละเอียด</label>
                                        <textarea name="details" id="details" required placeholder="อธิบายปัญหาของคุณ" class="form-control" rows="6"></textarea>
                                        <smail class="text-danger address"></smail>
                                    </div>
                                    <div class="">
                                        <input type="hidden">
                                        <button type="submit" name="report_btn" class="btn btn-primary w-40">รายงาน</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php
                            }
    ?>
    </div>
</div>
<!-- ส่งข้อมูลรูปภาพเดิมเพื่อนำไปใช้ในการอัปเดต -->



<?php include('includes/footer.php'); ?>