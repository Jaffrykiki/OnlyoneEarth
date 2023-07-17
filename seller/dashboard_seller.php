<?php
// include('authentication_seller.php');
$page_title = "Dashboard";
include('authentication.php');
include('../includes/header.php');
include('navbar_seller.php');
?>

<div class="py-5">
    .<div class="container">
        <div class="row">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (isset($_SESSION['status'])) {
                    ?>
                        <div class="alert alert-success">
                            <h5><?= $_SESSION['status']; ?></h5>
                        </div>
                    <?php
                        unset($_SESSION['status']);
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>User Dashboard</h4>
                        </div>
                        <div class="card-body">
                            <h4>Access when you are Logged IN</h4>
                            <hr>
                            <h5>Username: <?= $_SESSION['auth_seller']['S_Name']; ?></h5>
                            <h5>E-mail: <?= $_SESSION['auth_seller']['S_Email']; ?></h5>
                            <h5>Phone No : <?= $_SESSION['auth_seller']['S_phone']; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include('footer.php'); ?>