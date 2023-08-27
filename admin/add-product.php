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
                    <h4>เพิ่มสินค้า</h4>
                </div>
                <div class="card-body" style="margin-top: -40px;">
                <!-- แบบฟอร์มสำหรับเพิ่มสินค้า -->
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label class="mb-0">เลือกหมวดหมู่</label>
                                <!-- เลือกหมวดหมู่สำหรับสินค้า -->
                                <select name ="category_id" class="form-select mb-2">
                                    <option selected>เลือกหมวดหมู่</option>
                                    <?php
                                    $categories = getAll_category();

                                    if (mysqli_num_rows($categories) > 0) 
                                    {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "ไม่มีหมวดหมู่";
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">ชื่อ</label>
                                <input type="text" required name="name" placeholder="ป้อนชื่อหมวดหมู่" class="form-control mb-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">รายละเอียดสินค้า</label>
                               
                               <textarea row="3" required name="detail" placeholder="ป้อนรายละเอียดสินค้า" class="form-control mb-2"  ></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">อัปโหลดรูปภาพสินค้า</label>
                                <input  type="file" required name="images[]" multiple accept="image/*" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">ราคา</label>
                                <input type="text" required name="price" placeholder="ป้อนราคาสินค้า" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">จำนวน</label>
                                <input type="number" required name="num" placeholder="ป้อนจำนวนสินค้า" class="form-control mb-2">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">กำลังมาแรง</label>
                                <input type="checkbox"  name="trending">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!-- เลือกหมวดหมู่สำหรับสินค้า -->
                            <button type="submit" class="btn btn-primary" name="add_product_btn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- เลือกหมวดหมู่สำหรับสินค้า -->

<?php include('includes/footer.php') ?>