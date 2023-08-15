<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');

// ตรวจสอบว่ามีเลขพัสดุอยู่หรือไม่
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];

      // ตรวจสอบความถูกต้องของเลขพัสดุ
    $orderData = checkTrackingNoValid($tracking_no);
    if (mysqli_num_rows($orderData) < 0) {
?>
        <!-- แสดงข้อความเมื่อเลขพัสดุไม่ถูกต้อง -->
        <h4>มีบางอย่างผิดพลาด โปรดติดต่อแอดมินสมถุย</h4>
    <?php
        die(); // หยุดการทำงาน
    }
} else {
    ?>
    <!-- แสดงข้อความเมื่อไม่มีเลขพัสดุ -->
    <h4>มีบางอย่างผิดพลาด โปรดติดต่อแอดมินสมถุย</h4>
<?php
    die(); // หยุดการทำงาน
}

$data = mysqli_fetch_array($orderData);
?>

<!-- เริ่มส่วนของหน้าเว็บ -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <!-- แสดงหัวข้อของหน้ารายละเอียดออเดอร์ -->
                    <span class="text-white fs-3">รายละเอียดออเดอร์</span>
                    <a href="orders.php" class="btn btn-warning float-end"> <i class="fa fa-reply "></i>กลับ</a>
                </div>
                <div class="card-body">
                    <!-- แสดงข้อมูลรายละเอียดออเดอร์ -->
                    <div class="row">
                        <div class="col-md-6">
                            <h4>รายละเอียดการจัดส่ง</h4>
                            <hr>
                            <!-- แสดงข้อมูลการจัดส่ง -->
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">ชื่อ</label>
                                    <div class="border p-1">
                                        <?= $data['name'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">อีเมล์</label>
                                    <div class="border p-1">
                                        <?= $data['email'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">เบอร์โทรศัพท์</label>
                                    <div class="border p-1">
                                        <?= $data['phone'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">หมายเลขพัสดุ</label>
                                    <div class="border p-1">
                                        <?= $data['tracking_no'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">ที่อยู่</label>
                                    <div class="border p-1">
                                        <?= $data['address'] ?>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="fw-bold">รหัสไปษณีย์</label>
                                    <div class="border p-1">
                                        <?= $data['pincode'] ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>รายละเอียดออเดอร์</h4>
                            <hr>

                            <!-- แสดงตารางรายละเอียดสินค้าในออเดอร์ -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>สินค้า</th>
                                        <th>ราคา</th>
                                        <th>จำนวน</th>
                                    </tr>
                                </thead>
                                <!-- ส่วนเนื้อหาตาราง -->
                                <tbody>
                                    <?php
                                    // สร้างคำสั่ง SQL สำหรับดึงข้อมูลสินค้าในออเดอร์
                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi. *,oi.qty as orderqty, p.* FROM orders o, order_items oi,
                                        products p WHERE oi.order_id=o.id AND p.id=oi.prod_id 
                                        AND o.tracking_no='$tracking_no' ";

                                    // รันคำสั่ง SQL
                                    $order_query_run = mysqli_query($connection, $order_query);

                                    // ตรวจสอบว่ามีรายการสินค้าในออเดอร์หรือไม่
                                    if (mysqli_num_rows($order_query_run) > 0) {
                                        foreach ($order_query_run as $item) {
                                    ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="../uploads/<?= $item['image']; ?>" width="160px" height="160px" alt="<?= $item['name']; ?>">
                                                    <?= $item['name']; ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $item['price']; ?>
                                                </td>
                                                <td class="align-middle">
                                                    x<?= $item['orderqty']; ?>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                                    <!-- แสดงราคารวม -->
                            <hr>
                            <h4>ราคารวม : <span class="float-end fw-bold">฿<?= $data['total_price'] ?></span></h4>

                                    <!-- แสดงข้อมูลการชำระเงิน -->
                            <hr>
                            <label class="fw-bold">รูปแบบการชำระเงิน:</label>
                            <div class="border p-1 mb-3">
                                <?= $data['payment_mode'] ?>
                            </div>
                            <!-- แสดงสถานะออเดอร์และฟอร์มอัปเดตสถานะ -->
                            <label class="fw-bold">สถานะ</label>
                            <div class="mb-3">
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                                    <select name="order_status" class="form-select">
                                        <option value="0" <?= $data['status'] == 0 ?"selected":"" ?>>อยู่ระหว่างดำเนินการ</option>
                                        <option value="1" <?= $data['status'] == 1 ?"selected":"" ?>>ดำเนินการแล้ว</option>
                                        <option value="2" <?= $data['status'] == 2 ?"selected":"" ?>>ยกเลิกคำสั่งซื้อ</option>
                                    </select>
                                    <button type="submit" name="update_order_btn" class="btn btn-primary mt-3">อัปเดดสถานะ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>