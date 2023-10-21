<?php

include('../middleware/sellerMiddleware.php');
include('includes/header.php');

// ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
$sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ


$totalOrdersCount = getOrdersCount_seller($sellerId); //ฟังก์ชั่นเรียกดูออเดอร์ที่กำลังดำเนินการ
$totleOrderComplete = getOrdersComplete_seller($sellerId); //ฟังก์ชั่นเรียกดูออเดอร์ที่ดำเนินการแล้ว
$totleOrdercan = getOrdersCan_seller($sellerId); //ฟังก์ชั่นเรียกดูออเดอร์ที่ยกเลิก
$totalPriceWithStatus1 = getTotalPriceWithStatus1_seller($sellerId); // ฟังก์ชั่นเรียกดูยอดขายทั้งหมด ที่มีสถานะดดำเนินการแล้ว
$totalwithdraw = getTotalPriceWithdraw1_seller($sellerId); // ฟังก์ชั่นเรียกดูยอดเงินที่สามารถถอนได้



?>



<div class="container">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">

        <!-- ออเดอร์ที่กำลังดำเนินการ -->
        <div class="col">
            <div class="card mb-2">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-md icon-shape bg-gradient-info shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">view_list</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class="text-sm mb-0 text-capitalize">ออเดอร์ที่กำลังดำเนินการ</h4> <!-- เปลี่ยนเป็นหัวเรื่องของ Card -->
                        <p class="mb-0">จำนวน:<?php echo $totalOrdersCount; ?></p> <!-- เปลี่ยนเป็นเนื้อหาของ Card -->
                    </div>
                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">คุณมีออเดอร์ที่กำลังรอจัดส่ง
                </div>
            </div>
        </div>

        <!-- ออเดอร์ที่สำเร็จแล้ว -->
        <div class="col">
            <div class="card  mb-2 ">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">check_box</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class="text-sm mb-0 text-capitalize">ออเดอร์ที่สำเร็จแล้ว</h4>
                        <p class="mb-0">จำนวน:<?php echo $totleOrderComplete; ?></p>
                    </div>
                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-info text-sm font-weight-bolder">สำเร็จแล้ว!
                        </span></p>
                </div>
            </div>
        </div>

        <!-- ออเดอร์ที่มีการยกเลิก -->
        <div class="col">
            <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-md icon-shape bg-gradient-danger shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">cancel</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class="text-sm mb-0 text-capitalize">ออเดอร์ที่มีการยกเลิก</h4>
                        <p class="mb-0">จำนวน:<?php echo $totleOrdercan; ?></p>
                    </div>
                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-warning text-sm font-weight-bolder">อย่าเสียใจ!
                        </span></p>
                </div>
            </div>
        </div>

        <!-- สรุปยอดขายทั้งหมด -->
        <div class="col">
            <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">attach_money</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class="text-sm mb-0 text-capitalize">สรุปยอดขายทั้งหมด</h4>
                        <p class="mb-0">จำนวน:<?php echo $totalPriceWithStatus1; ?> บาท</p>
                    </div>
                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">ไปต่อ ไปอย่างมั่นคง!
                        </span></p>
                </div>
            </div>
        </div>
                <!-- สรุปยอดขายทั้งหมด -->
                <div class="col">
            <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">attach_money</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class="text-sm mb-0 text-capitalize">จำนวนเงินที่สามารถถอนได้</h4>
                        <p class="mb-0">จำนวน:<?php echo $totalwithdraw; ?> บาท</p>
                    </div>
                </div>

                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-warning text-sm font-weight-bolder">หมายเหตุ:จะมีการหักเปอร์เป็นจำนวนเงิน 6 % จากยอดขาย
                        </span></p>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php') ?>