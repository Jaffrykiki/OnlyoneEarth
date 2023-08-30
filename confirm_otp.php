<?php
// include header
include('includes/header.php');

// Start session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_otp = $_POST['otp'];

    // ตรวจสอบรหัส OTP ที่ผู้ใช้ป้อน
    if ($_SESSION['otp'] == $user_otp) {
        // รหัส OTP ถูกต้อง
        // ไปยังหน้าเปลี่ยนรหัสผ่านใหม่
        header('Location: reset_password.php');
        exit;
    } else {
        // รหัส OTP ไม่ถูกต้อง
        $error_message = "รหัส OTP ไม่ถูกต้อง";
    }
}
?>

<!-- ส่วนของการแสดงผลแบบฟอร์มยืนยัน OTP -->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>ยืนยันรหัส OTP</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($error_message)) {
                            echo '<div class="alert alert-danger">' . $error_message . '</div>';
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="otp" class="form-label">รหัส OTP</label>
                                <input type="text" required name="otp" class="form-control" placeholder="ป้อนรหัส OTP" id="otp">
                            </div>
                            <button type="submit" name="confirm_otp_btn" class="btn btn-success" style="display: block; margin: 0 auto;">ยืนยันรหัส OTP</button>
                            <br>
                        </form>
                        <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="reset_pass.php" class="btn btn-warning">กลับ</a>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
