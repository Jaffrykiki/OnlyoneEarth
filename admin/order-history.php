<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php');


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- เริ่มต้นของการแสดงประวัติคำสั่งซื้อ -->
            <div class="card">
                <div class="card-header">
                    <!-- ส่วนหัวของการแสดงผู้ใช้งาน -->
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="m-0">ประวัติคำสั่งซื้อที่ดำเนินการแล้ว</h4>
                        <!-- แบบฟอร์มสำหรับค้นหาผู้ใช้ -->
                        <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                            <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                            <a href="orders.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                        </form>
                    </div>
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
                            $Orders = getOrderHistroy();

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $orders = searchOrder_history($searchTerm);
                                if (!empty($orders)) {
                                    foreach ($orders as $order) {
                            ?>
                                        <tr>
                                            <td> <?= $order['id']; ?> </td>
                                            <td> <?= $order['name']; ?> </td>
                                            <td> <?= $order['tracking_no']; ?> </td>
                                            <td> <?= $order['total_price']; ?> </td>
                                            <td> <?= $order['created_at']; ?> </td>
                                            <td>
                                                <a href="view-order.php?t=<?= $order['tracking_no']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else if (empty($orders)) {
                                    echo "ไม่มีคำสั่งซื้อ";
                                }

                                // ตรวจสอบว่ามีคำสั่งซื้อหรือไม่
                            } else if (mysqli_num_rows($Orders) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลคำสั่งซื้อทั้งหมด
                                foreach ($Orders as $item) {
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