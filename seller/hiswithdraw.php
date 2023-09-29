<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');

// ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
$sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ

$nquery = mysqli_query($connection, "SELECT * from  withdrawals WHERE seller_id = '$sellerId' ");

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- เริ่มต้นของการแสดงรายการคำสั่งซื้อ -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="m-0">รายการถอนเงิน
                        <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                            <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                            <a href="withdraw.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                        </form>
                    </h4>
                </div>
                <div class="card-body" id="table-container" style="overflow-x:auto;">
                    <table class="table table-warning table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีการถอนเงิน</th>
                                <th>ไอดีผู้ขาย</th>
                                <th>อีเมล์</th>
                                <th>เลขที่บัญชีธนาคาร</th>
                                <th>ชื่อบัญชี</th>
                                <th>ชื่อธนาคาร</th>
                                <th>จำนวนเงิน</th>
                                <th>สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // เรียกใช้ฟังก์ชัน getAllwithdraw() เพื่อดึงข้อมูลรายการถอนเงิน
                            $withdraw = getAllwithdraw();

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            if ($nquery && mysqli_num_rows($nquery) > 0) {
                                // วนลูปเพื่อแสดงข้อมูลรายการคำสั่งซื้อทั้งหมด
                                while ($item = mysqli_fetch_assoc($nquery)) {
                                    ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['seller_id']; ?></td>
                                        <td><?= $item['email']; ?></td>
                                        <td><?= $item['numbank']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['namebank']; ?></td>
                                        <td><?= $item['numdraw']; ?></td>
                                        <td> <?php
                                                if ($item['status'] == 0) {
                                                    echo "รอการยืนยัน";
                                                } else if ($item['status'] == 1) {
                                                    echo "ยืนยันแล้ว";
                                                } else {
                                                    // กรณีอื่นๆ ที่ไม่ใช่ 0 หรือ 1
                                                    echo "สถานะไม่ทราบ";
                                                }
                                                ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                // ถ้าไม่มีรายการคำสั่งซื้อ
                                ?>
                                <tr>
                                    <td colspan="5"> ไม่มีรายการถอนเงิน </td>
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

<?php include('includes/footer.php') ?>
