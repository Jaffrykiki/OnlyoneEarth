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
                                <h8>จัดการข้อมูลส่วนตัวคุณเพื่อความปลอดภัยของบัญชีผู้ใช้นี้</h8>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">ไอดีผู้ใช้</label>
                                        <!-- แสดงไอดีผู้ใช้ที่ไม่สามารถแก้ไขได้ -->
                                        <input disabled type="text" name="id" value="<?= $data['id']; ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">ชื่อ</label>
                                        <!-- แสดงชื่อผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="text" required name="name" value="<?= $data['name']; ?>" required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">อีเมล์</label>
                                        <!-- แสดงอีเมล์ผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="text" required name="email" value="<?= $data['email']; ?>" required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="fw-bold">เบอร์โทรศัพท์</label>
                                        <!-- แสดงอีเมล์ผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="text" required name="phone" value="<?= $data['phone']; ?>" required class="form-control">
                                    </div>
                                    <div class="">
                                        <!-- แสดงอีเมล์ผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <input type="hidden">
                                        <button type="submit" name="update_profile_btn" class="btn btn-primary w-40">บันทึก</button>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <h5>รูปภาพของฉัน</h5>
                            <hr>
                            <div class="row align-items-center">
                                    <div class="d-flex text-center justify-content-center align-items-center">
                                        <!-- แสดงอีเมล์ผู้ใช้ที่สามารถแก้ไขได้ -->
                                        <img src="uploads/<?= $data['img']; ?>" alt="Image" width="120" style="border-radius: 50%;">
                                    </div>
                                <hr>
                                <h5>ขนาดไฟล์: สูงสุด 1 MB</h5>
                                <h5>ไฟล์ที่รองรับ: .JPEG, .PNG</h5>
                                <div class="col-md-12">
                                    <label class="mb-0">อัปโหลดรูปภาพโปรไฟล์</label>
                                    <!-- ส่งข้อมูลรูปภาพเดิมเพื่อนำไปใช้ในการอัปเดต -->
                                    <input type="hidden" name="old_image" value="<?= $data['img']; ?>">
                                    <!-- ส่งข้อมูลรูปภาพเดิมเพื่อนำไปใช้ในการอัปเดต -->
                                    <input type="file"  name="img" accept=".jpeg, .jpg, .png" class="form-control mb-2">
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