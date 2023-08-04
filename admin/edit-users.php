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

                $user = getByID("users", $id);

                if (mysqli_num_rows($user) > 0) 
                {
                    $data = mysqli_fetch_array($user);

            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit users
                                <a href="manage_users.php" class="btn btn-primary float-end">กลับ</a>
                            </h4>
                        </div>
                        <div class="card-body" style="margin-top: -40px;">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                    <input type="hidden" name="users_id" value="<?= $data['id']; ?>">
                                        <label class="mb-0">ชื่อ</label>
                                        <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="ป้อนชื่อที่ต้องการแก้ไข" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="mb-0">อีเมล์</label>
                                        <input type="text" required name="email" value="<?= $data['email']; ?>" placeholder="ป้อนอีเมล์ที่ต้องการแก้ไข" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">เบอร์โทรศัพท์</label>
                                        <input type="text" required name="phone" value="<?= $data['phone']; ?>"  placeholder="ป้อนเบอร์โทรศัพท์" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">รหัสผ่าน</label>
                                        <input type="number" required name="password" value="<?= $data['password']; ?>"  placeholder="ป้อนรหัสผ่าน" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">อัปโหลดรูปภาพผู้ใช้ใหม่</label>
                                        <input type="hidden" name="old_image" value="<?= $data['img']; ?>">
                                        <input type="file" name="image" class="form-control mb-2">
                                        <label class="mb-0">ภาพปัจจุบัน</label>
                                        <img src="../uploads/<?= $data['img']; ?>"  alt="Profile image" height="150px" width="150px">
                                    </div>
                                </div>
                                <div class="col-md-12">
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

<?php include('includes/footer.php') ?>