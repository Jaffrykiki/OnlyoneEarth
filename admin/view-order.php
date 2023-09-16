<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php');

// ตรวจสอบว่ามีพารามิเตอร์ 't' ที่ถูกส่งมาหรือไม่
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];

    // เรียกใช้ฟังก์ชัน checkTrackingNoValid เพื่อตรวจสอบความถูกต้องของหมายเลขพัสดุ
    $orderData = checkTrackingNoValid($tracking_no);

    // ตรวจสอบว่ามีข้อมูลออเดอร์หรือไม่
    if (mysqli_num_rows($orderData) < 0) {
?>
        <h4>มีบางอย่างผิดพลาด โปรดติดต่อแอดมินสมถุย</h4>
    <?php
        die();
    }
} else {
    ?>
    <h4>มีบางอย่างผิดพลาด โปรดติดต่อแอดมินสมถุย</h4>
<?php
    die();
}

// ดึงข้อมูลออเดอร์จากการสำรวจข้อมูลผ่าน mysqli_fetch_array()
$data = mysqli_fetch_array($orderData);
?>

<!-- เริ่มส่วนหน้าเว็บ -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <span class="text-white fs-3">รายละเอียดออเดอร์</span>
                    <a href="orders.php" class="btn btn-warning float-end"> <i class="fa fa-reply "></i>กลับ</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <h4>รายละเอียดการจัดส่ง</h4>
                            <hr>
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
                                <!-- ข้อมูลอื่น ๆ เช่น อีเมล์ เบอร์โทรศัพท์ หมายเลขพัสดุ ที่อยู่ รหัสไปษณีย์ -->       
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>รายละเอียดออเดอร์</h4>
                            <hr>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>สินค้า</th>
                                        <th>ราคา</th>
                                        <th>จำนวน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    // ดึงข้อมูลรายการสินค้าในออเดอร์จากการสำรวจฐานข้อมูล
                                    $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.*, pi.image_filename
                                    FROM orders o
                                    JOIN order_items oi ON o.id = oi.order_id
                                    JOIN products p ON p.id = oi.prod_id
                                    LEFT JOIN (
                                        SELECT product_id, MIN(image_filename) AS image_filename
                                        FROM product_images
                                        GROUP BY product_id
                                    ) AS pi ON p.id = pi.product_id
                                    WHERE o.tracking_no = '$tracking_no'
                                    ";

                                    $order_query_run = mysqli_query($connection, $order_query);

                                    if (mysqli_num_rows($order_query_run) > 0) {
                                        foreach ($order_query_run as $item) {
                                    ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="../uploads/<?= $item['image_filename']; ?>" width="160px" height="160px" alt="<?= $item['name']; ?>">
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
                            <!-- ส่วนของการแสดงราคารวม และข้อมูลการชำระเงิน สถานะ -->
                            <hr>
                            <h4>ราคารวม : <span class="float-end fw-bold">฿<?= $data['total_price'] ?></span></h4>

                            <hr>
                            <label class="fw-bold">รูปแบบการชำระเงิน:</label>
                            <div class="border p-1 mb-3">
                                <?= $data['payment_mode'] ?>
                            </div>
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