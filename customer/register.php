<?php
session_start();
$page_title = "Registration Form";
if (isset($_SESSION['authenticated'])) {
    $_SESSION['status'] = "You are already Logged In";
    header('Location: dashboard.php');
    exit(0);
}

include('../includes/header.php');
include('navbar_customer.php');
include('footer.php');
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-4 m-auto rounded-top wrapper">
            <h2 class="text-center pt-1">Signup Now</h2>
            <div class="alert">
                <?php
                if (isset($_SESSION['status'])) {
                    echo "<h4>" . $_SESSION['status'] . "</h4>";
                    unset($_SESSION['status']);
                }
                ?>
            </div>
            <p class="text-center text-muted lead ">
                <font size="2">Please fill in the fields below:</font>
            </p>
            <!-- Form Start -->
            <form action="sendemail.php" method="POST">
                <div class="input-group mb-3">
                    <span class="input-group-text "><i class="fa fa-user"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text "><i class="fa fa-phone"></i></span>
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text "><i class="fa fa-envelope"></i></span>
                    <input type="text" name="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text "><i class="fa fa-lock"></i></span>
                    <input type="text" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="d-grid">
                    <button type="submit" name="register_btn" class="btn btn-success">Signup Now</button>
                    <p class="text-center mt-3">
                        Already have an account? <a href="login.html">Login Here</a>
                    </p>
                </div>
            </form>
            <!-- Form close -->
        </div>
    </div>
</div>