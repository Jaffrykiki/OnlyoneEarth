<?php
include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');



//query
$query=mysqli_query($connection,"SELECT COUNT(id) FROM `products`");
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

    $limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;

    // ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
    $sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ

    $query = "
        SELECT p.id, p.category_id, p.users_id, p.name, p.detail, p.price, p.image, p.num, p.trending, p.created_at, pi.image_filename
        FROM products p
        LEFT JOIN (
            SELECT product_id, MIN(image_filename) as image_filename
            FROM product_images
            GROUP BY product_id
        ) pi ON p.id = pi.product_id
        WHERE p.users_id = $sellerId
        $limit
    ";
    
    $nquery = mysqli_query($connection, $query);
    

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
            <!-- เริ่มต้นของการแสดงรายการสินค้า -->
            <div class="card">
                <div class="card-header">
                    <!-- ส่วนหัวของการแสดงผู้ใช้งาน -->
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4  class="m-0">สินค้าทั้งหมด</h4>
                        <!-- แบบฟอร์มสำหรับค้นหาผู้ใช้ -->
                        <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                            <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                            <a href="products.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                        </form>
                    </div>
                    <a  href="logs_products.php" class="btn btn-secondary float-end">ตรวจสอบบันทึก</a>
                </div>
                <div id="og" class="card-body table-responsive" id="products_table">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีสินค้า</th>
                                <th>ไอดีผู้ใช้</th>
                                <th>ชื่อสินค้า</th>
                                <th>รูปภาพสินค้า</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // เรียกใช้ฟังก์ชัน getAll("products") เพื่อดึงข้อมูลรายการสินค้าทั้งหมด
                            // $Products = getAll_product();

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $products = searchProducts($searchTerm);
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                            ?>
                                        <tr>
                                            <td><?= $product['id']; ?></td>
                                            <td><?= $product['users_id']; ?></td>
                                            <td><?= $product['name']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $product['image']; ?>" width="130px" height="130px" alt="<?= $item['name']; ?>">
                                            </td>
                                            <td>
                                                <a href="edit-product.php?id=<?= $product['id']; ?>" class="btn btn-primary">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $product['id']; ?>">ลบ</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else if (empty($products)) {
                                    echo "ค้นหาสินค้าไม่เจอ";
                                }
                            } // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            else if ($nquery && mysqli_num_rows($nquery) > 0) {
                                while ($item = mysqli_fetch_assoc($nquery)) {
                                    ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['users_id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                            <img src="../uploads/<?= $item['image_filename']; ?>" width="130px" height="130px" alt="<?= $item['name']; ?>">
                                        </td>
                                        <td>
                                            <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-primary">แก้ไข</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $item['id']; ?>">ลบ</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {

                                // ถ้าไม่มีรายการสินค้า
                                echo "ไม่พบบันทึก";
                            }
                            ?>

                        </tbody>

                    </table>
                </div>
            </div>
            <!-- สิ้นสุดการแสดงรายการสินค้า -->
        </div>
        <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>	
    </div>
</div>




<?php include('includes/footer.php') ?>