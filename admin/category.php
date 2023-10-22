<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware adminMiddleware.php เพื่อตรวจสอบสิทธิ์ผู้ดูแลระบบ
include('includes/header.php');

//query
$query = mysqli_query($connection, "SELECT COUNT(id) FROM `category`");
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

$nquery = mysqli_query($connection, "SELECT * from  category $limit");

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

<!-- เริ่มต้นส่วนของเนื้อหา -->
<div class="container">
    <div id="og" class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- ส่วนหัวของการแสดงผู้ใช้งาน -->
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="m-0">หมวดหมู่สินค้า</h4>
                        <!-- แบบฟอร์มสำหรับค้นหาผู้ใช้ -->
                        <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                            <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                            <a href="category.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                        </form>
                    </div>
                    <a href="logs_category.php" class="btn btn-secondary float-end">ตรวจสอบบันทึก</a>
                </div>
                <div class="card-body table-responsive" id="category_table">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีหมวดหมู่</th>
                                <th>ชื่อหมวดหมู่</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $categorys = searchCategories($searchTerm);
                                if (!empty($categorys)) {
                                    foreach ($categorys as $category) {
                            ?>
                                        <tr>
                                            <td><?= $category['id']; ?></td>
                                            <td><?= $category['name']; ?></td>
                                            <td>
                                                <!-- ปุ่มแก้ไขที่เชื่อมโยงไปยังหน้าแก้ไขหมวดหมู่ -->
                                                <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary">แก้ไข</a>
                                            </td>
                                            <td>
                                                <!-- ปุ่มลบที่เรียกใช้งานจากไฟล์ JavaScript -->
                                                <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= $item['id']; ?>">ลบ</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else  if (empty($categorys)) {
                                    echo "ค้นหาหมวดหมู่สินค้าไม่เจอ";
                                }
                            }   // ตรวจสอบว่ามีข้อมูลหมวดหมู่หรือไม่
                            else if ($nquery && mysqli_num_rows($nquery) > 0) {
                                while ($item = mysqli_fetch_assoc($nquery)) {
                                    ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                            <!-- ปุ่มแก้ไขที่เชื่อมโยงไปยังหน้าแก้ไขหมวดหมู่ -->
                                            <a href="edit-category.php?id=<?= $item['id']; ?>" class="btn btn-primary">แก้ไข</a>
                                        </td>
                                        <td>
                                            <!-- ปุ่มลบที่เรียกใช้งานจากไฟล์ JavaScript -->
                                            <button type="button" class="btn btn-sm btn-danger delete_category_btn" value="<?= $item['id']; ?>">ลบ</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "ยังไม่มีหมวดหมู่สินค้า";
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
<!-- จบส่วนของเนื้อหา -->




<?php include('includes/footer.php') ?>