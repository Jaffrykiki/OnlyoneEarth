<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php');


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
             <!-- เริ่มต้นของการแสดงประวัติคำสั่งซื้อ -->
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">ประวัติคำสั่งซื้อ
                        <a href="orders.php" class="btn btn-warning float-end">กลับ</a>
                    </h4>
                </div>
                <div class="card-body" id="">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อผู้ซื้อ</th>
                                <th>หมายเลขพัสดุ</th>
                                <th>รวมการสั่งซื้อ</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // เรียกใช้ฟังก์ชัน getOrderHistroy() เพื่อดึงข้อมูลคำสั่งซื้อ
                            $orders = getOrderHistroy();

                            // ตรวจสอบว่ามีคำสั่งซื้อหรือไม่
                            if (mysqli_num_rows($orders) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลคำสั่งซื้อทั้งหมด
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
                                        <td> <?= $item['name']; ?> </td>
                                        <td> <?= $item['tracking_no']; ?> </td>
                                        <td> <?= $item['total_price']; ?> </td>
                                        <td> <?= $item['created_at']; ?> </td>
                                        <td>
                                            <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                // ถ้าไม่มีคำสั่งซื้อ
                                ?>
                                <tr>
                                    <td colspan="5"> ไม่มีคำสั่งซื้อ </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- สิ้นสุดการแสดงประวัติคำสั่งซื้อ -->
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>