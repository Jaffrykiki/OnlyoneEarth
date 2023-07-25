<?php

include('../middleware/sellerMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                </div>
                <div class="card-body " id="products_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id_Product</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $products = getAll("products",true);
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) {
                            ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
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