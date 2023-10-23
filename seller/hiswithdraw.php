<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');


//query
$query=mysqli_query($connection, "SELECT COUNT(id) FROM  withdrawals ");
	$row = mysqli_fetch_row($query);

	$rows = $row[0];

	$page_rows = 5;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) {
		$pagenum = 1;
	}
	else if ($pagenum > $last) {
		$pagenum = $last;
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

    // ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
    $sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ

    $query = " SELECT * from  withdrawals WHERE seller_id = $sellerId $limit";

	$nquery=mysqli_query($connection,$query);

	$paginationCtrls = '';

	if($last != 1){

	if ($pagenum > 1) {
$previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'#og" class="btn btn-info">Previous</a> &nbsp; &nbsp; ';

		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
        // $paginationCtrls .= '<a href="#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
			}
	}
}

	$paginationCtrls .= ''.$pagenum.' &nbsp; ';

	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'#og" class="btn btn-primary">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

if ($pagenum != $last) {
$next = $pagenum + 1;
$paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'#og" class="btn btn-info">Next</a> ';
}
	}

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
                                    <td colspan="8"> ไม่มีรายการถอนเงิน </td>
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

<?php include('includes/footer.php') ?>
