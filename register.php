<?php
session_start();

// ตรวจสอบว่ามีเซสชัน auth หรือไม่
if (isset($_SESSION['auth'])) {
    $_SESSION['message'] = "คุณได้เข้าสู่ระบบแล้ว"; // กำหนดข้อความในเซสชันและเปลี่ยนเส้นทางไปที่ index.php
    header('Location:index.php');
    exit(); // จบการทำงานเพื่อป้องกันการทำงานต่อหลังจากเปลี่ยนเส้นทาง
}


include('includes/header.php');
?>

<!-- เริ่มส่วนแสดงฟอร์มสมัครสมาชิก -->
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                // ตรวจสอบว่ามีเซสชันข้อความหรือไม่
                if (isset($_SESSION['message'])) {
                ?>
                    <!-- แสดงข้อความแจ้งเตือนเมื่อมีเซสชันข้อความ -->
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Status:</strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    // ลบเซสชันข้อความหลังจากแสดงข้อความแจ้งเตือน
                    unset($_SESSION['message']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>แบบฟอร์มสมัครสมาชิก</h4>
                    </div>
                    <div class="card-body">
                        <!-- // ลบเซสชันข้อความหลังจากแสดงข้อความแจ้งเตือน -->
                        <form action="funtion/authcode.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">ชื่อ</label>
                                <!-- ช่องกรอกชื่อ -->
                                <input type="text" name="name" required class="form-control" placeholder="ป้อนชื่อที่คุณต้องการสร้าง" pattern="[A-Za-z]+" title="โปรดลองใหม่อีกครั้ง">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">เบอร์โทร</label>
                                <!-- ช่องกรอกเบอร์โทรศัพท์ -->
                                <input type="tel" name="phone" required class="form-control" placeholder="ป้อนเบอร์โทรศัพท์" pattern="[0-9]{10}" title="โปรดป้อนหมายเลขโทรศัพท์ 10 หลัก">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">อีเมล์</label>
                                <!-- ช่องกรอกอีเมล์ -->
                                <input type="email" name="email" required class="form-control" placeholder="ป้อนอีเมล์ของคุณ" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">รหัสผ่าน</label>
                                <!-- ช่องกรอกรหัสผ่าน -->
                                <input type="password" name="password" required class="form-control" placeholder="ป้อนรหัสผ่านที่คุณต้องการสร้าง" id="exampleInputPassword1" pattern=".{8,}" title="รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ยืนยันรหัสผ่าน</label>
                                <!-- ช่องกรอกยืนยันรหัสผ่าน -->
                                <input type="password" name="cpassword" required class="form-control" placeholder="ยืนยันรหัสของคุณอีกครั้ง" id="exampleInputcPassword1" pattern=".{8,}" title="รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร">
                            </div>
                            <!-- ปุ่มสำหรับส่งข้อมูลการสมัครสมาชิก -->
                            <button type="submit" name="register_btn" class="btn btn-primary">ยืนยัน</button>
                        </form>
                        <!-- สิ้นสุดฟอร์มสำหรับส่งข้อมูลการสมัครสมาชิก -->

                        <div class="row text-center" style="margin-top: 20px;">
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-warning">กลับไปหน้าหลัก</a>
                            </div>
                            <div class="col-md-6">
                                <a href="login.php" class="btn btn-success">เข้าสู่ระบบ</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- สิ้นสุดส่วนแสดงฟอร์มสมัครสมาชิก -->


<?php include('includes/footer.php'); ?>