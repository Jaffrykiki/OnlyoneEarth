<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');


?>

<!-- เริ่มต้นเนื้อหา -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            // ตรวจสอบว่ามีการส่งพารามิเตอร์ 'id' ผ่าน URL หรือไม่
            if (isset($_GET['id'])) {
                
                $id = $_GET['id'];
                // ดึงข้อมูลหมวดหมู่ที่ต้องการแก้ไขจากฐานข้อมูล
                $category =  getByID("category", $id);

                // ตรวจสอบว่ามีข้อมูลหมวดหมู่ที่ได้จากฐานข้อมูลหรือไม่
                if (mysqli_num_rows($category) > 0) {
                    // ตรวจสอบว่ามีข้อมูลหมวดหมู่ที่ได้จากฐานข้อมูลหรือไม่
                    $date = mysqli_fetch_array($category);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไขหมวดหมู่
                                <!-- ปุ่มกลับไปยังหน้ารายการหมวดหมู่ -->
                                <a href="category.php" class="btn btn-primary float-end">กลับ</a>
                            </h4>
                            </h4>
                        </div>
                        <div class="card-body">
                            <!-- แบบฟอร์มสำหรับแก้ไขหมวดหมู่ -->
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <!-- ฟิลด์ที่ซ่อนไว้สำหรับเก็บค่า id ของหมวดหมู่ที่แก้ไข -->
                                        <input type="hidden" name="category_id" value="<?= $date['id']  ?>">
                                        <label for="">ชื่อ</label>
                                        <!-- ฟิลด์ในแบบฟอร์มสำหรับกรอกชื่อหมวดหมู่ -->
                                        <input type="text" name="name" value="<?= $date['name']  ?>" placeholder="ป้อนชื่อหมวดหมู่" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- ปุ่มสำหรับบันทึกการแก้ไขหมวดหมู่ -->
                                    <button type="submit" class="btn btn-primary" name="update_category_btn">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "ไม่พบหมวดหมู่";
                }
            } else {
                echo "รหัสหายไปจาก url";
            }
            ?>
        </div>
    </div>
</div>
<!-- สิ้นสุดเนื้อหา -->



<?php include('includes/footer.php') ?>