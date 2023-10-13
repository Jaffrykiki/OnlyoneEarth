<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');

$totalOrdersCount = getOrdersCount(); //ฟังก์ชั่นเรียกดูออเดอร์ที่กำลังดำเนินการ
$totleOrderComplete = getOrdersComplete(); //ฟังก์ชั่นเรียกดูออเดอร์ที่ดำเนินการแล้ว
$percentageIncrease = getPercentageIncrease(); //ฟังก์ชันสำหรับการดึงข้อมูลเปอร์เซ็นต์เพิ่มขึ้นจากฐานข้อมูล
$totleOrdercan = getOrdersCan(); //ฟังก์ชั่นเรียกดูออเดอร์ที่ยกเลิก
$totalPriceWithStatus1 = getTotalPriceWithStatus1(); // ฟังก์ชั่นเรียกดูยอดขายทั้งหมด  ORder_item
$seller = getUsersWithCondition();  // ฟังก์ชั่นเรียกดูผู้ขาย ที่มีสถานะ verify = 1 และ role = 2
$userCount = getUser(); // ฟังก์ชั่นเรียกดูผ้ซื้อ ที่มีสถานะ role_as = 0

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
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">อัตราการซื้อ
                        </span><?php echo $percentageIncrease; ?>%</p>
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

        <!-- ผู้ขาย -->
        <div class="col">
            <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                    <div class="icon icon-md icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">store</i>
                    </div>
                    <div class="text-end pt-1">
                        <h3 class="text-sm mb-0 text-capitalize ">ผู้ขาย</h3>
                        <p class="mb-0 ">จำนวนผู้ขาย:<?php echo $seller ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ผู้ซื้อ -->
        <div class="col">
            <div class="card">
                <div class="card-header p-3 pt-2 bg-transparent">
                    <div class="icon icon-md icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">people</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class="text-sm mb-0 text-capitalize ">ผู้ซื้อ</h4>
                        <p class="mb-0">จำนวนผู้ซื้อ:<?php echo $userCount; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("into.php");
// รับค่า parameter p จาก URL
$p = (isset($_GET['p']) ? $_GET['p'] : '');
// ใช้เงื่อนไขในการเลือกเนื้อหาที่จะแสดงตามค่า parameter p
    if($p=='daily'){
      include('r_daily.php');
    }elseif($p=='monthy'){
      include('r_monthy.php');
    }elseif($p=='yearly'){
      include('r_yearly.php');
    }else{
        // ถ้าไม่ตรงกับเงื่อนไขใดเลย ให้แสดงเนื้อหาจากไฟล์ 'r_daily.php'
      include('r_daily.php');
    }
?>

<div class="d-flex justify-content-between">
    <img src="../uploads/Monkey_D_Garp.webp" alt="Left Image" class="img-fluid" style="max-width: 20%; height: auto;">
</div>

<?php include('includes/footer.php') ?>