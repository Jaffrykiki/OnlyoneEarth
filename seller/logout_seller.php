<?php
session_start();

unset($_SESSION['authenticated_seller']);
unset($_SESSION['auth_seller']);
$_SESSION['status'] = "You Logged Out Successfully";
header("Location: login_seller.php");


?>