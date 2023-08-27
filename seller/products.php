<?php
include('../middleware/sellerMiddleware.php'); // เรียกใช้ middleware เพื่อตรวจสอบสิทธิ์ผู้ใช้
include('includes/header.php');

// ดึงข้อมูลผู้ขายที่เข้าสู่ระบบ เพื่อใช้เป็นเงื่อนไขในการดึงรายการออเดอร์
$sellerId = $_SESSION['auth_user']['id']; // ต้องปรับตามโครงสร้างของ session ที่ใช้ในระบบ

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>สินค้า</h4>
                </div>
                <div class="card-body " id="products_table">
                    <!-- สร้างตารางสำหรับแสดงรายการสินค้า -->
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th>ไอดีสินค้า</th>
                                <th>ชื่อสินค้า</th>
                                <th>รูปภาพสินค้า</th>
                                <th>แก้ไข</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // ดึงข้อมูลสินค้าทั้งหมด
                            $products = getAll_product_seller($sellerId);

                            // ตรวจสอบว่ามีข้อมูลสินค้าหรือไม่
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                            <!-- แสดงรูปภาพสินค้า -->
                                            <img src="../uploads/<?= $item['image']; ?>" width="130px" height="130px" alt="<?= $item['name']; ?>">
                                        </td>
                                        <td>
                                            <!-- ลิงก์ไปยังหน้าแก้ไขสินค้า -->
                                            <a href="edit-product.php?id=<?= $item['id']; ?>" class="btn btn-primary">แก้ไข</a>

                                        </td>
                                        <td>
                                            <!-- ปุ่มลบสินค้า -->
                                        <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $item['id']; ?>">ลบ</button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "ไม่พบบันทึก";
                            }
                            ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php') ?>