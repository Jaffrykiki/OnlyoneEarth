<?php
include('../middleware/adminMiddleware.php');
include('includes/header.php');

//query
$query=mysqli_query($connection,"SELECT COUNT(id) FROM `users`");
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

	$nquery=mysqli_query($connection,"SELECT * from  users $limit");

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

<!-- เริ่มต้นส่วนเนื้อหา -->
<div class="container">
    <div id="og" class="row">
        <div class="col-md-12">
            <div class="card" style="width: 70rem;">
                <!-- ส่วนหัวของการแสดงผู้ใช้งาน -->
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="m-0">ผู้ใช้ทั้งหมด
                        <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                            <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                            <a href="manage_users.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                        </form>
                    </h4>
                    <a href="logs_users.php" class="btn btn-warning float-end">ประวัติการทำรายการ</a>
                </div>
                <!-- ตารางแสดงผู้ใช้ -->
                <div class="card-body table-responsive" style="width: 100%;"  id="users_table">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีผู้ใช้</th>
                                <th>บทบาท</th>
                                <th>ชื่อ</th>
                                <th>อีเมล์</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>รหัสผ่าน</th>
                                <th>รูปภาพ</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // ดึงข้อมูลผู้ใช้ทั้งหมดจากฐานข้อมูล
                            $users = getAll("users");
                            // ตรวจสอบการค้นหาผู้ใช้
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $Users = searchUsers($searchTerm);
                                if (!empty($Users)) {
                                    foreach ($Users as $user) {
                                        // แสดงข้อมูลผู้ใช้ที่ค้นหา
                            ?>
                                        <tr>
                                            <td width="50px" height="50px"><?= $user['id']; ?></td>
                                            <td width="50px" height="50px">
                                                <?php
                                                // แปลงรหัสบทบาทเป็นข้อความ
                                                if ($user['role_as'] == 0) {
                                                    echo "ผู้ซื้อ";
                                                } elseif ($user['role_as'] == 1) {
                                                    echo "แอดมิน";
                                                } elseif ($user['role_as'] == 2) {
                                                    echo "ผู้ขาย";
                                                } else {
                                                    echo "ค่าไม่ตรงกับที่คาดหวัง";
                                                }
                                                ?>
                                            </td>
                                            <!-- แสดงข้อมูลอื่น ๆ ของผู้ใช้ -->
                                            <td><?= $user['name']; ?></td>
                                            <td><?= $user['email']; ?></td>
                                            <td><?= $user['phone']; ?></td>
                                            <td><?= $user['password']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $user['img']; ?>" width="120px" height="120px" alt="<?= $user['name']; ?>">
                                            </td>
                                            <td>
                                                <a href="edit-users.php?id=<?= $user['id']; ?>" class="btn btn-primary">แก้ไข</a>

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger delete_users_btn" value="<?= $user['id']; ?>">ลบ</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else if (empty($Users)) {
                                    echo "ไม่เจอผู้ใช้ที่ค้นหา";
                                }
                            } 
                            else if ($nquery && mysqli_num_rows($nquery) > 0) {
                                while ($item = mysqli_fetch_assoc($nquery)) {
                                    // แสดงข้อมูลผู้ใช้ทั้งหมด
                                    ?>
                                    <tr>
                                        <td width="50px" height="50px"><?= $item['id']; ?></td>
                                        <td width="50px" height="50px">
                                            <?php
                                            if ($item['role_as'] == 0) {
                                                echo "ผู้ซื้อ";
                                            } elseif ($item['role_as'] == 1) {
                                                echo "แอดมิน";
                                            } elseif ($item['role_as'] == 2) {
                                                echo "ผู้ขาย";
                                            } else {
                                                echo "ค่าไม่ตรงกับที่คาดหวัง";
                                            }
                                            ?>
                                        </td>

                                        <td><?= $item['name']; ?></td>
                                        <td><?= $item['email']; ?></td>
                                        <td><?= $item['phone']; ?></td>
                                        <td><?= $item['password']; ?></td>
                                        <td>
                                            <img src="../uploads/<?= $item['img']; ?>" width="120px" height="120px" alt="<?= $item['name']; ?>">
                                        </td>
                                        <td>
                                            <a href="edit-users.php?id=<?= $item['id']; ?>" class="btn btn-primary">แก้ไข</a>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger delete_users_btn" value="<?= $item['id']; ?>">ลบ</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "ไม่มีผู้ใช้งาน";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>	
    </div>
</div>




<?php include('includes/footer.php'); ?>