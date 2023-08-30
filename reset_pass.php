<?php 
include('includes/header.php');



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
                                    <label for="exampleInputEmail1" class="form-label">อีเมล์</label>
                                    <input type="email" required name="email" class="form-control" placeholder="ป้อนอีเมล์ของคุณ" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <button type="submit" name="send_otp_btn" class="btn btn-success" style="display: block; margin: 0 auto;">ต่อไป</button> 
                                <br>
                            </form>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="login.php" class="btn btn-warning">กลับ</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>