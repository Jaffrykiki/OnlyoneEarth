<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');


?>

<!-- เริ่มต้นส่วนเนื้อหา -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            // ตรวจสอบว่ามีการส่งพารามิเตอร์ 'id' ผ่าน URL หรือไม่
            if (isset($_GET['id'])) {

                $id = $_GET['id'];

                // ดึงข้อมูลผลิตภัณฑ์ที่ต้องการแก้ไขจากฐานข้อมูล
                $product = getByID("products", $id);

                // ตรวจสอบว่ามีข้อมูลผลิตภัณฑ์ที่ได้จากฐานข้อมูลหรือไม่
                if (mysqli_num_rows($product) > 0) {

                     // ดึงข้อมูลของผลิตภัณฑ์จากผลลัพธ์ที่ได้
                    $data = mysqli_fetch_array($product);
            ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไข สินค้า
                                <!-- ปุ่มกลับไปยังหน้ารายการผลิตภัณฑ์ -->
                                <a href="products.php" class="btn btn-primary float-end">กลับ</a>
                            </h4>
                        </div>
                        <div class="card-body" style="margin-top: -40px;">
                        <!-- แบบฟอร์มสำหรับแก้ไขผลิตภัณฑ์ -->
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <div class="col-md-5">
                                        <label class="mb-0">เลือกหมวดหมู่</label>
                                        <!-- เลือกหมวดหมู่ผลิตภัณฑ์จากเลือกเมนู -->
                                        <select name="category_id" class="form-select mb-2">
                                            <option selected>เลือกหมวดหมู่</option>
                                            <?php
                                             // ดึงข้อมูลหมวดหมู่ทั้งหมดจากฐานข้อมูล
                                            $categories = getAll_category();
                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                            ?>
                                             <!-- แสดงรายการหมวดหมู่ในแบบเลือก -->
                                                    <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id'] ? 'selected' : '' ?>><?= $item['name']; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "ไม่มีหมวดหมู่";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- ฟิลด์ที่ซ่อนไว้สำหรับเก็บค่า id ของผลิตภัณฑ์ที่แก้ไข -->
                                    <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
                                    <div class="col-md-12">
                                        <label class="mb-0">ชื่อ</label>
                                        <!-- ฟิลด์สำหรับกรอกชื่อผลิตภัณฑ์ -->
                                        <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="ป้อนชื่อหมวดหมู่" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">รายละเอียดสินค้า</label>
                                            <!-- ฟิลด์สำหรับกรอกรายละเอียดผลิตภัณฑ์ -->
                                        <textarea row="3" required name="detail" placeholder="ป้อนรายละเอียดสินค้า" class="form-control mb-2"><?= $data['detail']; ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">อัปโหลดรูปภาพสินค้า</label>
                                         <!-- ฟิลด์ที่ซ่อนไว้สำหรับเก็บชื่อรูปภาพเดิม -->
                                        <input type="hidden" name="old_image" value="<?= $data['image_filename']; ?>">
                                         <!-- ฟิลด์สำหรับเลือกและอัปโหลดรูปภาพใหม่ -->
                                        <input type="file" name="image" class="form-control mb-2">
                                        <label class="mb-0">ภาพปัจจุบัน</label>
                                         <!-- แสดงภาพปัจจุบันของผลิตภัณฑ์ -->
                                        <img src="../uploads/<?= $data['image_filename']; ?>" alt="Product image" height="150px" width="150px">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">ราคา</label>
                                        <!-- ฟิลด์สำหรับกรอกราคาผลิตภัณฑ์ -->
                                        <input type="text" required name="price" value="<?= $data['price']; ?>" placeholder="ป้อนราคาสินค้า" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">จำนวน</label>
                                        <!-- ฟิลด์สำหรับกรอกจำนวนผลิตภัณฑ์ -->
                                        <input type="number" required name="num" value="<?= $data['num']; ?>" placeholder="ป้อนจำนวนสินค้า" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="mb-0">กำลังมาแรง</label>
                                        <!-- ฟิลด์สำหรับกรอกจำนวนผลิตภัณฑ์ -->
                                        <input type="checkbox" name="trending" <?= $data['trending'] == '0' ? '' : 'checked' ?>>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- ปุ่มสำหรับบันทึกการแก้ไขผลิตภัณฑ์ -->
                                    <button type="submit" class="btn btn-primary" name="update_product_btn">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
                } else {
                    echo "ไม่พบผลิตภัณฑ์ที่ระบุรหัส";
                }
            } else {
                echo "Id missing from url";
            }
            ?>
        </div>
    </div>
</div>
<!-- ปุ่มสำหรับบันทึกการแก้ไขผลิตภัณฑ์ -->

<?php include('includes/footer.php') ?>