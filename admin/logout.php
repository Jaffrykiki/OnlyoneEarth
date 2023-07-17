<?php
session_start();

unset($_SESSION['authenticated_admin']);
unset($_SESSION['auth_admin']);
$_SESSION['status'] = "You Logged Out Successfully";
header("Location: index.php");


?>