<?php 
session_start();


if(!isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "Please Login to Access User Dashboard";
    header('Location: login.php');
    exit(0);
}
else if(!isset($_SESSION['authenticated_seller']))
{
    $_SESSION['status'] = "Please Login to Access User Dashboard";
    header('Location: login_seller.php');
    exit(0);
}



 


?> 