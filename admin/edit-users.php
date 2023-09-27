<?php

include('../middleware/adminMiddleware.php'); // เรียกใช้ไฟล์ middleware สำหรับตรวจสอบสิทธิ์ของแอดมิน
include('includes/header.php');


?>

<!-- เริ่มต้นส่วนเนื้อหา -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php

            // ตรวจสอบว่ามีการส่งพารามิเตอร์ 'id' ผ่าน URL หรือไม่
            if (isset($_GET['id'])) {

                // ดึงค่า id จาก URL
                $id = $_GET['id'];

                // ดึงข้อมูลผู้ใช้ที่ต้องการแก้ไขจากฐานข้อมูล
                $user = getByID("users", $id);

                // ตรวจสอบว่ามีข้อมูลผู้ใช้ที่ได้จากฐานข้อมูลหรือไม่
                if (mysqli_num_rows($user) > 0) 
                {
                    // ดึงข้อมูลของผู้ใช้จากผลลัพธ์ที่ได้
                    $data = mysqli_fetch_array($user);

            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไขผู้ใช้
                                <!-- ปุ่มกลับไปยังหน้าจัดการผู้ใช้ -->
                                <a href="manage_users.php" class="btn btn-primary float-end">กลับ</a>
                            </h4>
                        </div>
                        <div class="card-body" style="margin-top: -40px;">
                        <!-- แบบฟอร์มสำหรับแก้ไขข้อมูลผู้ใช้ -->
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <!-- ฟิลด์ที่ซ่อนไว้สำหรับเก็บค่า id ของผู้ใช้ที่แก้ไข -->
                                    <input type="hidden" name="users_id" value="<?= $data['id']; ?>">
                                        <label class="mb-0">ชื่อ</label>
                                        <!-- ฟิลด์สำหรับกรอกชื่อผู้ใช้ -->
                                        <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="ป้อนชื่อที่ต้องการแก้ไข" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="mb-0">อีเมล์</label>
                                        <!-- ฟิลด์สำหรับกรอกอีเมล์ผู้ใช้ -->
                                        <input type="text" required name="email" value="<?= $data['email']; ?>" placeholder="ป้อนอีเมล์ที่ต้องการแก้ไข" class="form-control mb-2" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" title="โปรดป้อนอีเมล์ที่ถูกต้อง">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">เบอร์โทรศัพท์</label>
                                        <!-- ฟิลด์สำหรับกรอกเบอร์โทรศัพท์ผู้ใช้ -->
                                        <input type="text" required name="phone" value="<?= $data['phone']; ?>" placeholder="ป้อนเบอร์โทรศัพท์" class="form-control mb-2" pattern="[0-9]{10}" title="โปรดป้อนหมายเลขโทรศัพท์ 10 หลัก">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">รหัสผ่าน</label>
                                        <!-- ฟิลด์สำหรับกรอกรหัสผ่านผู้ใช้ -->
                                        <input type="text" required name="password" value="<?= $data['password']; ?>"  placeholder="ป้อนรหัสผ่าน" class="form-control mb-2" minlength="8" pattern=".{8,}" title="รหัสผ่านควรมีอย่างน้อย 8 ตัวอักษร">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">อัปโหลดรูปภาพผู้ใช้ใหม่</label>
                                        <!-- ฟิลด์ที่ซ่อนไว้สำหรับเก็บชื่อรูปภาพเดิม -->
                                        <input type="hidden" name="old_image" value="<?= $data['img']; ?>">
                                        <!-- ฟิลด์สำหรับอัปโหลดรูปภาพใหม่ -->
                                        <input type="file" name="img" class="form-control mb-2">
                                        <label class="mb-0">ภาพปัจจุบัน</label>
                                        <!-- แสดงภาพปัจจุบันของผู้ใช้ -->
                                        <img src="../uploads/<?= $data['img']; ?>"  alt="Profile image" height="160px" width="160px">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- ปุ่มสำหรับบันทึกการแก้ไขข้อมูลผู้ใช้ -->
                                    <button type="submit" class="btn btn-primary" name="update_users_btn">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } 
                else 
                {
                    echo "ไม่พบผลิตภัณฑ์ที่ระบุรหัส";
                }
            } 
            else 
            {
                echo "Id missing from url";
            }
            ?>
        </div>
    </div>
</div>
<!-- สิ้นสุดส่วนเนื้อหา -->

<?php include('includes/footer.php') ?>