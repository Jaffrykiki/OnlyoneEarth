<?php
// Include header
include('includes/header.php');

// เริ่มต้นเซสชัน
session_start();

// ดึงค่าอีเมล์จากเซสชัน (หากมีการเก็บ)
if (isset($_SESSION['reset_email'])) {
    $reset_email = $_SESSION['reset_email'];
} else {
    // หากไม่มีค่าอีเมล์ในเซสชัน ให้เรียกกลับไปหน้าอื่น เช่น confirm_otp.php หรือ reset_password.php
    header('Location: confirm_otp.php'); // หรือไปยังหน้าอื่นที่คุณต้องการ
    exit;
}


?>
    
    <!-- ส่วนของการแสดงผลแบบฟอร์มเข้าสู่ระบบ -->
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php
                    // ตรวจสอบว่ามีข้อความเซสชันเก็บไว้หรือไม่ ถ้ามีให้แสดงข้อความแจ้งเตือน
                    if (isset($_SESSION['message'])) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Status:</strong> <?= $_SESSION['message']; ?>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                        // เคลียร์ข้อความเซสชันหลังจากแสดงผลแล้ว
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>ตั้งรหัสผ่านใหม่</h4>
                        </div>
                        <div class="card-body">
                            <!-- แบบฟอร์มสำหรับกรอกข้อมูลเข้าสู่ระบบ -->
                            <form action="funtion/authcode.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">รหัสผ่านใหม่</label>
                                    <input type="password" required name="new_password" class="form-control" placeholder="ป้อนรหัสผ่านใหม่ของคุณ" id="new_password">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">ยืนยันรหัสผ่าน</label>
                                    <input type="password" required name="confirm_new_password" class="form-control" placeholder="ยืนยันรหัสผ่านใหม่ของคุณ" id="confirm_new_password" aria-describedby="emailHelp">
                                </div>
                                <button type="submit" name="reset_password_btn" class="btn btn-success" style="display: block; margin: 0 auto;">ยืนยัน</button> 
                                <br>
                            </form>
                            <?php
                            if (isset($error_message)) {
                                echo '<div class="alert alert-danger">' . $error_message . '</div>';
                            }
                            ?>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="resset_pass.php" class="btn btn-warning">กลับ</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>