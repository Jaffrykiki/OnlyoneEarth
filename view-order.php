<?php

include('funtion/userfunction.php');
include('includes/header.php');
include('includes/navbar.php');

include('authenticate.php');

//ตรวจสอบว่ามีเลขพัสดุอยู่หรือไม่
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no); // เรียกใช้ฟังก์ชันเพื่อตรวจสอบความถูกต้องของเลขพัสดุ
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

$data = mysqli_fetch_array($orderData);
?>

<!-- เริ่มส่วนแสดงเนื้อหาของหน้าเว็บ -->
<div class="py-3 bg-primary">
    <div class="container">
        <h7 class="text-white">
            <a href="index.php" class="text-white">
                หน้าแรก /
            </a>
            <a href="my-orders.php" class="text-white">
                ออเดอร์ /
            </a>
            <a href="#" class="text-white">
                รายละเอียดออเดอร์
            </a>
        </h7>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <span class="text-white fs-3">รายละเอียดออเดอร์</span>
                            <a href="my-orders.php" class="btn btn-warning float-end"> <i class="fa fa-reply "></i>กลับ</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>รายละเอียดการจัดส่ง</h4>
                                    <hr>
                                    <div class="row">
                                        <!-- แสดงข้อมูลชื่อ, อีเมล์, เบอร์โทรศัพท์, หมายเลขพัสดุ, ที่อยู่, รหัสไปษณีย์ -->
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
                                    <!-- แสดงรายละเอียดออเดอร์เช่น รายการสินค้า, ราคารวม, รูปแบบการชำระเงิน, สถานะ -->
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
                                            // ดึงค่า id ของผู้ใช้ที่เข้าสู่ระบบจาก session
                                            $userId = $_SESSION['auth_user']['id'];

                                            // สร้างคำสั่ง SQL ในการดึงข้อมูลออเดอร์และรายการสินค้าที่เกี่ยวข้อง
                                            $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi. *,oi.qty as orderqty, p.* FROM orders o, order_items oi,
                                        products p WHERE o.user_id='$userId' AND oi.order_id=o.id AND p.id=oi.prod_id 
                                        AND o.tracking_no='$tracking_no' ";

                                            // ทำการ query ไปยังฐานข้อมูล   
                                            $order_query_run = mysqli_query($connection, $order_query);

                                            // ตรวจสอบว่ามีข้อมูลที่ได้จากการ query หรือไม่
                                            if (mysqli_num_rows($order_query_run) > 0) {
                                                // วนลูปแสดงรายการสินค้าที่เกี่ยวข้องในตาราง
                                                foreach ($order_query_run as $item) {
                                            ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img src="uploads/<?= $item['image']; ?>" width="160px" height="160px" alt="<?= $item['name']; ?>">
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

                                    <hr>
                                    <h4>ราคารวม : <span class="float-end fw-bold">฿<?= $data['total_price'] ?></span></h4>

                                    <hr>
                                    <label class="fw-bold">รูปแบบการชำระเงิน:</label>
                                    <div class="border p-1 mb-3">
                                        <?= $data['payment_mode'] ?>
                                    </div>
                                    <label class="fw-bold">สถานะ:</label>
                                    <div class="border p-1 mb-3">
                                        <?php
                                        if ($data['status'] == 0) {
                                            echo "อยู่ระหว่างดำเนินการ";
                                        } else if ($data['status'] == 1) {
                                            echo "ดำเนินการแล้ว";
                                        } else if ($data['status'] == 2) {
                                            echo "ยกเลิกแล้ว";
                                        }
                                        ?>
                                    </div>
                                    <?php if ($data['status'] == 0): ?>
                                        <button type="button" class="btn btn-danger mt-3 cancel_order" data-tracking="<?= $tracking_no ?>" data-status="2">ยกเลิกคำสั่งซื้อ</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>