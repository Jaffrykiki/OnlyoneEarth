<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');


?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- แสดงหัวข้อของหน้าเพิ่มสินค้า -->
                    <h4>เพิ่มสินค้า</h4>
                </div>
                <div class="card-body" style="margin-top: -40px;">
                <!-- เริ่มฟอร์มสำหรับเพิ่มสินค้า -->
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label class="mb-0">เลือกหมวดหมู่</label>
                                <!-- เลือกหมวดหมู่สินค้า -->
                                <select name ="category_id" class="form-select mb-2">
                                    <option selected>เลือกหมวดหมู่</option>
                                    <?php
                                    // ดึงข้อมูลหมวดหมู่ทั้งหมด
                                    $categories = getAll("category");

                                    // ตรวจสอบว่ามีข้อมูลหมวดหมู่หรือไม่
                                    if (mysqli_num_rows($categories) > 0) 
                                    {
                                        foreach ($categories as $item) {
                                    ?>
                                            <!-- แสดงรายการหมวดหมู่เป็นตัวเลือก -->      
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
                            <!-- ส่วนอื่น ๆ ของฟอร์ม เช่น ชื่อ, รายละเอียด, รูปภาพ, ราคา, จำนวน -->
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
                        </div>
                        <div class="col-md-12">
                            <!-- ปุ่มสำหรับบันทึกข้อมูลสินค้า -->
                            <button type="submit" class="btn btn-primary" name="add_product_btn">บันทึก</button>
                        </div>
                    </form>
                    <!-- ปุ่มสำหรับบันทึกข้อมูลสินค้า -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>