<?php
include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- เริ่มต้นของการแสดงรายการสินค้า -->
            <div class="card">
                <div class="card-header">
                    <h4>สินค้า</h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-dark table-striped">
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
                            $products = getAll("products");

                             // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            if (mysqli_num_rows($products) > 0) {

                                 // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                                foreach ($products as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['users_id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                            <img src="../uploads/<?= $item['image']; ?>" width="130px" height="130px" alt="<?= $item['name']; ?>">
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
    </div>
</div>




<?php include('includes/footer.php') ?>