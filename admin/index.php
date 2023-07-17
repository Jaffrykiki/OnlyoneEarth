<?php
$page_title = "Admin Login Form";
session_start();

if (isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already Logged In";
    header('Location: dashboard.php');
    exit(0);
}

include('includes/header.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 m-auto rounded-top wrapper">
                <h2 class="text-center pt-3">Admin Login Page</h2>
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
                        <button type="submit" name="login_admin_btn" class="btn btn-success">Login</button>
                        
                    </div>
                </form>
                <!-- Form close -->
            </div>
        </div>
    </div>

</body>


</html>
<?php include("includes/script.php"); ?>