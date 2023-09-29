<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- แสดงหัวข้อของหน้าเพิ่มสินค้า -->
                    <h4>ทำรายการถอนเงิน</h4>
                </div>
                <div class="card-body" style="margin-top: -40px;">
                <!-- เริ่มฟอร์มสำหรับเพิ่มสินค้า -->
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label class="mb-0">เลขที่บัญชีธนาคาร</label>
                                <input type="text" required name="numbank" placeholder="ป้อนเลขที่บัญชีธนาคาร" class="form-control mb-2" pattern="[0-9]{1,}" title="กรุณากรอกเฉพาะตัวเลขของหมายเลขธนาคาร">
                            </div>
                            <!-- ส่วนอื่น ๆ ของฟอร์ม เช่น ชื่อ, รายละเอียด, รูปภาพ, ราคา, จำนวน -->
                            <div class="col-md-5">
                                <label class="mb-0">ชื่อบัญชี</label>
                                <input type="text" required name="name" placeholder="ป้อนชื่อบัญชี" class="form-control mb-2" pattern="[a-zA-Zก-๙\s]+" title="ชื่อบัญชีธนาคารต้องประกอบด้วยตัวอักษรเท่านั้น">
                            </div>
                            <div class="col-md-5">
                                <label class="mb-0">ชื่อธนาคาร</label>
                                <input type="text" required name="namebank" placeholder="ป้อนชื่อธนาคาร" class="form-control mb-2" pattern="[a-zA-Zก-๙\s]+" title="ชื่อธนาคารต้องประกอบด้วยตัวอักษรเท่านั้น" >
                            </div>
                            <div class="col-md-5">
                                <label class="mb-0">จำนวนเงินที่ต้องการถอน</label>
                                <input type="text" required name="numdraw" placeholder="ป้อนจำนวนเงินที่ต้องการถอน" class="form-control mb-2" pattern="[0-9]+(\.[0-9]{2})?" title="กรุณาป้อนจำนวนเงินให้ถูกต้อง (ตัวอย่าง: 100.00)">
                            </div>
                            <div class="col-md-5">
                                <label class="mb-0">อีเมล</label>
                                <input type="email" required name="email" placeholder="ป้อนอีเมล์" class="form-control mb-2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- ปุ่มสำหรับบันทึกข้อมูลการถอนเงิน -->
                            <button type="submit" class="btn btn-primary" name="add_withdraw_btn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
