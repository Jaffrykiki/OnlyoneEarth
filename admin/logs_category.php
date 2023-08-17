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
                    <h4 class="m-0">เหตุการ์ณทั้งหมด  </h4>
                    <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                        <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                        <a href="add-category.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                    </form>
                </div>
                <div class="card-body" id="">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ไอดีผู้ใช้</th>
                                <th>รหัสหมวดหมู่</th>
                                <th>เหตุการณ์</th>
                                <th>วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php
                            // เรียกใช้ฟังก์ชัน getAllOrders() เพื่อดึงข้อมูลรายการคำสั่งซื้อทั้งหมด
                            $Orders = getAllOrders();

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                         if (mysqli_num_rows($Orders) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลรายการคำสั่งซื้อทั้งหมด
                                foreach ($Orders as $item) {
                            ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
                                        <td> 1 </td>
                                        <td> 1  </td>
                                        <td> ลบสินค้า </td>
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