<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('includes/navbar.php');

include('authenticate.php');

?>

<!-- เริ่มส่วนของเนื้อหาหน้าเว็บ -->
<div class="py-3 bg-primary">
    <div class="container">
        <!-- แถบเนวิเกชันสีน้ำเงินด้านบนของหน้าเว็บ -->
        <h7 class="text-white">
            <a href="index.php" class="text-white">
                หน้าแรก /
            </a>
            <a href="my-orders.php" class="text-white">
                ออเดอร์
            </a>
        </h7>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <!-- ส่วนของการแสดงรายการออเดอร์ -->
        <div class="card card-body shadow">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>หมายเลขพัสดุ</th>
                                <th>รวมการสั่งซื้อ</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // ดึงข้อมูลรายการออเดอร์โดยใช้ฟังก์ชัน
                            $orders = getOrders();
                            if (mysqli_num_rows($orders) > 0) {
                                foreach ($orders as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
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
        </div>
    </div>
</div>
<!-- สิ้นสุดส่วนของเนื้อหาหน้าเว็บ -->




<?php include('includes/footer.php'); ?>