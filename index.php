<?php 
session_start(); 
include('includes/header.php');

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- แจ้งเดือนหลังจากเข้าสู่ระบบ -->
                <?php
                if (isset($_SESSION['message'])) {
                ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Status:</strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
                <h1>Hello, world! <i class="fa fa-user"></i></h1>
                <button class="btn btn-primary">เทส </button>
            </div>
        </div>
    </div>
</div>




<?php include('includes/footer.php'); ?>