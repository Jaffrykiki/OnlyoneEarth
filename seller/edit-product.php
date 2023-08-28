<?php

include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');


?>

<!-- เริ่มส่วนของหน้าเว็บ -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            //ตรวจสอบว่ามีพารามิเตอร์ชื่อ "id" ถูกส่งมาใน URL หรือไม่
            if (isset($_GET['id'])) {

                //ตรวจสอบว่ามีพารามิเตอร์ชื่อ "id" ถูกส่งมาใน URL หรือไม่
                $id = $_GET['id'];

                // ดึงข้อมูลสินค้าโดยใช้ ID
                $product = getByID("products", $id);

                // ตรวจสอบว่ามีรายการสินค้าที่ตรงกับ ID ที่ส่งมาหรือไม่
                if (mysqli_num_rows($product) > 0) 
                {
                    $data = mysqli_fetch_array($product);

            ?>
            <!-- เริ่มส่วนแก้ไขข้อมูลสินค้า -->
                    <div class="card">
                        <div class="card-header">
                            <!-- แสดงหัวข้อของหน้าแก้ไขสินค้า -->
                            <h4>แก้ไขสินค้า
                            <a href="products.php" class="btn btn-primary float-end">กลับ</a>
                            </h4>
                            </h4>
                        </div>
                        <div class="card-body" style="margin-top: -40px;">
                        <!-- เริ่มส่วนแก้ไขข้อมูลสินค้า -->
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <div class="col-md-5">
                                        <label class="mb-0">เลือกหมวดหมู่</label>
                                        <select name="category_id" class="form-select mb-2">
                                            
                                            <option selected>เลือกหมวดหมู่</option>
                                            <?php
                                            $categories = getAll_category();

                                            if (mysqli_num_rows($categories) > 0) {
                                                foreach ($categories as $item) {
                                            ?>
                                            <!-- แสดงรายการหมวดหมู่ทั้งหมดและเลือกหมวดหมู่ปัจจุบันของสินค้า -->
                                                    <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id']?'selected':''?> ><?= $item['name']; ?></option>
                                            <?php
                                                }
                                            } else {
                                                echo "ไม่มีหมวดหมู่";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
                                    <div class="col-md-12">
                                        <label class="mb-0">ชื่อ</label>
                                        <!-- แสดงชื่อสินค้าปัจจุบันใน input -->
                                        <input type="text" required name="name" value="<?= $data['name']; ?>" placeholder="ป้อนชื่อหมวดหมู่" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">รายละเอียดสินค้า</label>
                                        <!-- แสดงรายละเอียดสินค้าปัจจุบันใน textarea -->
                                        <textarea row="3" required name="detail" placeholder="ป้อนรายละเอียดสินค้า" class="form-control mb-2"><?= $data['detail']; ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">อัปโหลดรูปภาพสินค้า</label>
                                         <!-- อัปโหลดรูปภาพใหม่ และแสดงรูปภาพปัจจุบัน -->
                                        <input type="hidden" name="old_image" value="<?= $data['image_filename']; ?>">
                                        <input type="file" name="image" class="form-control mb-2">
                                        <label class="mb-0">ภาพปัจจุบัน</label>
                                        <img src="../uploads/<?= $data['image_filename']; ?>"  alt="Product image" height="150px" width="150px">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">ราคา</label>
                                         <!-- แสดงราคาสินค้าปัจจุบันใน input -->
                                        <input type="text" required name="price" value="<?= $data['price']; ?>"  placeholder="ป้อนราคาสินค้า" class="form-control mb-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">จำนวน</label>
                                          <!-- แสดงจำนวนสินค้าปัจจุบันใน input -->
                                        <input type="number" required name="num" value="<?= $data['num']; ?>"  placeholder="ป้อนจำนวนสินค้า" class="form-control mb-2">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- ปุ่มบันทึกข้อมูลสินค้าที่ถูกแก้ไข -->
                                    <button type="submit" class="btn btn-primary" name="update_product_btn">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                     <!-- สิ้นสุดส่วนแก้ไขข้อมูลสินค้า -->
            <?php
                } 
                else 
                {
                    echo "ไม่พบผลิตภัณฑ์ที่ระบุรหัส";
                }
            } 
            else 
            {
                echo "Id missing from url";
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>