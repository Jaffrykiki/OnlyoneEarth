<?php

include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware adminMiddleware.php เพื่อตรวจสอบสิทธิ์ผู้ดูแลระบบ
include('includes/header.php');

?>

<!-- เริ่มต้นส่วนของเนื้อหา -->
<div class="container">
    <div class="row">
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
                            <a href="category.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; " >กลับ</a> 
                        </form>
                    </div>
                    <a href="logs_category.php" class="btn btn-secondary float-end">ตรวจสอบบันทึก</a>
                </div>
                <div class="card-body" id="category_table">
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
                            // ดึงข้อมูลหมวดหมู่ทั้งหมดด้วยฟังก์ชัน getAll() จาก Myfunction
                            $caregories = getAll("category");
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
                        else if (mysqli_num_rows($caregories) > 0) {
                            foreach ( $caregories as $item) {
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
    </div>
</div>
<!-- จบส่วนของเนื้อหา -->




<?php include('includes/footer.php') ?>