<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php');

//query
$query = mysqli_query($connection, "SELECT COUNT(id) FROM `orders`");
$row = mysqli_fetch_row($query);

$rows = $row[0];

$page_rows = 5;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

$last = ceil($rows / $page_rows);

if ($last < 1) {
    $last = 1;
}

$pagenum = 1;

if (isset($_GET['pn'])) {
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}

if ($pagenum < 1) {
    $pagenum = 1;
} else if ($pagenum > $last) {
    $pagenum = $last;
}

$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

$nquery = mysqli_query($connection, "SELECT * from  orders $limit");

$paginationCtrls = '';

if ($last != 1) {

    if ($pagenum > 1) {
        $previous = $pagenum - 1;
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '#og" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

        for ($i = $pagenum - 4; $i < $pagenum; $i++) {
            if ($i > 0) {
                $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '#og" class="btn btn-primary">' . $i . '</a> &nbsp; ';
                // $paginationCtrls .= '<a href="#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
            }
        }
    }

    $paginationCtrls .= '' . $pagenum . ' &nbsp; ';

    for ($i = $pagenum + 1; $i <= $last; $i++) {
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '#og" class="btn btn-primary">' . $i . '</a> &nbsp; ';
        if ($i >= $pagenum + 4) {
            break;
        }
    }

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $next . '#og" class="btn btn-info">Next</a> ';
    }
}


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- เริ่มต้นของการแสดงรายการคำสั่งซื้อ -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="m-0">ออเดอร์ทั้งหมด
                        <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                            <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                            <a href="orders.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                        </form>
                    </h4>
                    <a href="order-history.php" class="btn btn-warning float-end">ประวัติคำสั่งซื้อที่ดำเนินการแล้ว</a>
                    <br>
                    <a href="logs_order.php" class="btn btn-secondary ">ตรวจสอบบันทึก</a>
                </div>
                <div class="card-body" id="">
                    <table class="table table-info table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อผู้ซื้อ</th>
                                <th>ไอดีผู้ขาย</th>
                                <th>หมายเลขพัสดุ</th>
                                <th>รวมการสั่งซื้อ</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>รายละเอียดเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            // เรียกใช้ฟังก์ชัน getAllOrders() เพื่อดึงข้อมูลรายการคำสั่งซื้อทั้งหมด
                            $Orders = getAllOrders();

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $orders = searchOrders($searchTerm);
                                if (!empty($orders)) {
                                    foreach ($orders as $order) {
                            ?>
                                        <tr>
                                            <td> <?= $order['id']; ?> </td>
                                            <td> <?= $order['name']; ?> </td>
                                            <td> <?= $order['sellerId']; ?> </td>
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
                                    echo "ค้นหาออเดอร์ไม่เจอ";
                                }
                            } // ตรวจสอบว่ามีรายการคำสั่งซื้อหรือไม่
                            else if ($nquery && mysqli_num_rows($nquery) > 0) {
                                while ($item = mysqli_fetch_assoc($nquery)) {
                                    ?>
                                    <tr>
                                        <td> <?= $item['id']; ?> </td>
                                        <td> <?= $item['name']; ?> </td>
                                        <td> <?= $item['sellerId']; ?> </td>
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
        <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
    </div>
</div>




<?php include('includes/footer.php'); ?>