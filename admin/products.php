<?php
include('../middleware/adminMiddleware.php'); // นำเข้าไฟล์ middleware ที่ใช้ตรวจสอบสิทธิ์ของผู้ดูแลระบบ
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- เริ่มต้นของการแสดงรายการสินค้า -->
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="m-0">สินค้าทั้งหมด</h4>
                    <!-- แบบฟอร์มสำหรับค้นหาผู้ใช้ -->
                    <form class="d-flex m-0" role="search" style="max-width: 550px; height: 50px;">
                        <input class="form-control me-2" type="search" name="searchTerm" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit" style="width: 200px; height: 50px;">ค้นหา</button>
                        <a href="products.php" class="form-control me-4" style="width: 100px; height: 50px; border-radius: 5px; ">กลับ</a>
                    </form>
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
                            $Products = getAll("products");

                            // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                            if (isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
                                $searchTerm = $_GET['searchTerm'];
                                // <!-- ดึงข้อมูลสินค้าจากคำค้นหา -->
                                $products = searchProducts($searchTerm);
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                            ?>
                                        <tr>
                                            <td><?= $product['id']; ?></td>
                                            <td><?= $product['users_id']; ?></td>
                                            <td><?= $product['name']; ?></td>
                                            <td>
                                                <img src="../uploads/<?= $product['image']; ?>" width="130px" height="130px" alt="<?= $item['name']; ?>">
                                            </td>
                                            <td>
                                                <a href="edit-product.php?id=<?= $product['id']; ?>" class="btn btn-primary">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $product['id']; ?>">ลบ</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } else if (empty($products)) {
                                    echo "ค้นหาสินค้าไม่เจอ";
                                }
                            } else if (mysqli_num_rows($Products) > 0) {
                                // ตรวจสอบว่ามีรายการสินค้าหรือไม่
                                foreach ($Products as $item) {
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