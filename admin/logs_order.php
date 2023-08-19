<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php'); 


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- เริ่มต้นของการแสดงรายการคำสั่งซื้อ -->
            <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="m-0">ตรวจสอบบันทึก</h4>
                    <a href="orders.php" class="btn btn-primary float-end">กลับ</a>
                </div>
                <div class="card-body" id="">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ไอดีแอดมิน</th>
                                <th>รหัสออเดอร์</th>
                                <th>เหตุการณ์</th>
                                <th>วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            // เรียกใช้ฟังก์ชัน getAll("category_logs") เพื่อดึงข้อมูลรายการสินค้าทั้งหมด
                            $Logs = getLogs_Order();

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                         if (mysqli_num_rows($Logs) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลรายการคำสั่งซื้อทั้งหมด
                                foreach ($Logs as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['or_logs_id']; ?> </td>
                                        <td> <?= $item['u_id']; ?></td>
                                        <td> <?= $item['ord_id']; ?></td>
                                        <td> <?= $item['event']; ?></td>
                                        <td> <?= $item['created_at']; ?> </td>   
                                    </tr>
                                <?php
                                }
                            } else {
                                // ถ้าไม่มีรายการคำสั่งซื้อ
                                ?>
                                <tr>
                                    <td colspan="5"> ไม่มีเหตุการณ์ </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- สิ้นสุดการแสดงรายการคำสั่งซื้อ --> 
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>