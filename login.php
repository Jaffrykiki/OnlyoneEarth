<?php
session_start();
include('includes/header.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Status:</strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>เข้าสู่ระบบ</h4>
                    </div>
                    <div class="card-body">
                        <form action="funtion/authcode.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">อีเมล์</label>
                                <input type="email" name="email" class="form-control" placeholder="ป้อนอีเมล์ของคุณ" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">รหัสผ่าน</label>
                                <input type="password" name="password" class="form-control" placeholder="ป้อนรหัสผ่านของคุณ" id="exampleInputPassword1">
                            </div>
                            <button type="submit" name="login_btn" class="btn btn-success ">เข้าสู่ระบบ</button>
                            <!-- Register buttons -->
                            <div class="text-center mb-2">
                                <p>เพิ่งเคยเข้ามาใน Only One Earth ใช่หรือไม่? </p>
                                <a href="register.php" class="btn btn-secondary">สมัครใหม่</a>
                                <p>หรือล็อกอินด้วย:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fa fa-google" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>