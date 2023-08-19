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
                    <h4 class="m-0">คำร้อง </h4>
                </div>
                <div class="card-body" id="">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อผู้รายงาน</th>
                                <th>เรื่อง</th>
                                <th>รายละเอียด</th>
                                <th>รูปภาพสินค้า</th>
                                <th>วันที่รายงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            // เรียกใช้ฟังก์ชัน getAllOrders() เพื่อดึงข้อมูลรายการคำสั่งซื้อทั้งหมด
                            $Orders = getAllReports();
                            if (mysqli_num_rows($Orders) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลรายการคำสั่งซื้อทั้งหมด
                                foreach ($Orders as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
                                        <td> <?= $item['user_id']; ?> </td>
                                        <td> <?= $item['subject']; ?> </td>
                                        <td> <?= $item['details']; ?> </td>
                                        <td>
                                                <img src="../uploads/<?= $item['img']; ?>" width="130px" height="130px">
                                            </td>
                                        <td> <?= $item['created_at']; ?> </td>
                                       
                                    </tr>
                                <?php
                                }
                            } else {
                                // ถ้าไม่มีรายการคำสั่งซื้อ
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
            <!-- สิ้นสุดการแสดงรายการคำสั่งซื้อ --> 
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>