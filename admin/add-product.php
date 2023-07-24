<?php

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body" style="margin-top: -40px;">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label class="mb-0">เลือกหมวดหมู่</label>
                                <select name ="category_id" class="form-select mb-2">
                                    <option selected>เลือกหมวดหมู่</option>
                                    <?php
                                    $categories = getAll("category");

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
                                <input  type="file" required name="image" class="form-control mb-2">
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
                            <button type="submit" class="btn btn-primary" name="add_product_btn">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>