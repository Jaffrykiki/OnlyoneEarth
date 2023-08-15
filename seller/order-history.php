<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');


?>

<!-- เริ่มส่วนของหน้าเว็บ -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <!-- แสดงหัวข้อของหน้าประวัติคำสั่งซื้อ -->
                    <h4 class="text-white">ประวัติคำสั่งซื้อ
                        <a href="orders.php" class="btn btn-warning float-end">กลับ</a>
                    </h4>
                </div>
                <div class="card-body" id="">
                    <!-- แสดงตารางประวัติคำสั่งซื้อ -->
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
                            // ดึงข้อมูลประวัติคำสั่งซื้อ
                            $orders = getOrderHistroy();

                             // ตรวจสอบว่ามีคำสั่งซื้อในประวัติหรือไม่
                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
                                        <td> <?= $item['name']; ?> </td>
                                        <td> <?= $item['tracking_no']; ?> </td>
                                        <td> <?= $item['total_price']; ?> </td>
                                        <td> <?= $item['created_at']; ?> </td>
                                        <td>
                                            <!-- สร้างลิงก์ไปยังหน้าแสดงรายละเอียดออเดอร์ -->
                                            <a href="view-order.php?t=<?= $item['tracking_no']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <!-- แสดงข้อความเมื่อไม่มีคำสั่งซื้อ -->
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
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>