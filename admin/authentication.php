<?php 
session_start();


if(!isset($_SESSION['authenticated_admin']))
{
    $_SESSION['status'] = "Please Login to Access User Dashboard";
    header('Location: index.php');
    exit(0);
}



 


?> 