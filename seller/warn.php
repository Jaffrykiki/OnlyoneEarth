<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');


// ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
$sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-danger">
                        <!-- แสดงหัวข้อของหน้าแจ้งเตือน -->
                    <h4 class="text-white">แจ้งเตือน</h4>
                </div>
                <div class="card-body" id="">
                    <!-- สร้างตารางสำหรับแสดงรายการออเดอร์ -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อสินค้า</th>
                                <th>รูปภาพสินค้า</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // ดึงข้อมูลรายการออเดอร์ทั้งหมด
                            $products = getAllproduct_seller($sellerId);

                            // ตรวจสอบว่ามีรายการออเดอร์หรือไม่
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
                                        <td> <?= $item['name']; ?> </td>
                                        <td>
                                            <!-- แสดงรูปภาพสินค้า -->
                                            <img src="../uploads/<?= $item['image_filename']; ?>" width="130px" height="130px" alt="<?= $item['name']; ?>">
                                        </td>
                                        <td>สินค้าชิ้นนี้ของคุณใกล้จะหมดแล้วในร้าน</td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <!-- แสดงข้อความเมื่อไม่มีรายการออเดอร์ -->
                                    <td colspan="5">ไม่มีคำเตือน</td>
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