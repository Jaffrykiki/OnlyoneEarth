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
                    <h4>หมวดหมู่สินค้า</h4>
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
                            // ดึงข้อมูลหมวดหมู่ทั้งหมดด้วยฟังก์ชัน getAll() จาก middleware
                            $category = getAll("category");
                            // ตรวจสอบว่ามีข้อมูลหมวดหมู่หรือไม่
                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
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
                                // ถ้าไม่มีข้อมูลหมวดหมู่
                                echo "ไม่พบหมวดหมู่";
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