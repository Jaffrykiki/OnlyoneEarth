<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('authenticate.php');
include('includes/navbar.php'); 


?>

<!-- เริ่มส่วนแสดงข้อมูลของผู้ใช้ -->
<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card card-body shadow">
                <!-- เริ่มฟอร์มสำหรับการแก้ไขข้อมูลผู้ใช้ -->
                <form action="funtion/authcode.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-7">
                            <?php
                            // วน loop แสดงข้อมูลผู้ใช้ที่ได้รับมา 
                            $items = getUsers();
                            foreach ($items as $data) {
                            ?>
                                <h5 class="fw-bold">ข้อมูลของฉัน</h5>
                                <h5>จัดการข้อมูลส่วนตัวคุณเพื่อความปลอดภัยของบัญชีผู้ใช้นี้</h5> 
                                <br>
                                <h12>หากต้องการกลับสู่หน้าโปรไฟล์</h12>  <a href="profile.php">คลิกที่นี้</a>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">ไอดีผู้ใช้</label>
                                        <!-- แสดงไอดีผู้ใช้ที่ไม่สามารถแก้ไขได้ -->
                                        <input disabled type="text" name="id" value="<?= $data['id']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">รหัสผ่านเดิม</label>
                                        <!-- แสดงชื่อผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="password" required name="old_password" value="" required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">รหัสผ่านใหม่</label>
                                        <!-- แสดงอีเมล์ผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="password" required name="new_password" value="" required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">ยืนยันรหัสผ่าน</label>
                                        <!-- แสดงอีเมล์ผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="password" required name="confirm_password" value="" required class="form-control">
                                    </div>
                                    <div class="">
                                        <input type="hidden">
                                        <button type="submit" name="update_password_btn" class="btn btn-primary w-40">บันทึก</button>
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


<?php include('includes/footer.php'); ?>