<?php
$page_title = "Login Form";
session_start();

if (isset($_SESSION['authenticated_seller'])) {
    $_SESSION['status'] = "You are already Logged In";
    header('Location: dashboard_seller.php');
    exit(0);
}

include('../includes/header.php');
include('navbar_seller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 m-auto rounded-top wrapper">
                <h2 class="text-center pt-3">Login</h2>
                <p class="text-center text-muted lead ">
                    <font size="2">Please enter your e-mail and password:</font>
                </p>

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

                <!-- Form Start -->
                <form action="../funtion/authcode.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text "><i class="fa fa-envelope"></i></span>
                        <input type="text" name="email" class="form-control" placeholder="E-mail">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text "><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="login_seller_btn" class="btn btn-success">Login</button>
                        <p class="text-center mt-3">
                            New Seller? <a href="register_seller.php">Create an account</a>
                        </p>
                    </div>
                </form>
                <!-- Form close -->
            </div>
        </div>
    </div>
</body>

</html>


<?php include('footer.php'); ?>