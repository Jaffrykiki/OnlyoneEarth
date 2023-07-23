<?php
include('includes/header.php');
include('../middleware/adminMiddleware.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Categories</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $category = getAll("category");
                            if(mysqli_num_rows($category) > 0) 
                            {
                                foreach ($category as $item) 
                                {
                                    ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-primary">แก้ไข</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } 
                            else 
                            {
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