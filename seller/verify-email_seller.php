<?php 
session_start();
include ('../connection/dbcon.php');

if(isset($_GET['token'])) 
{
    $token = $_GET['token'];
    $verify_query = "SELECT Verify_token,Verify_status FROM table_seller WHERE Verify_token ='$token' LIMIT 1";
    $verify_query_run = mysqli_query($connection, $verify_query);
    
    if(mysqli_num_rows($verify_query_run) >0)
    {
        $row = mysqli_fetch_array($verify_query_run);
        if($row['Verify_status'] == "0")
        {
            $click_token = $row['Verify_token'];
            $update_query = "UPDATE table_seller SET Verify_status='1' WHERE Verify_token='$click_token' LIMIT 1";
            $update_query_run = mysqli_query($connection, $update_query);  
            
            if($update_query_run)
            {
                $_SESSION['status'] = "Your Account has been verified Successfully.!";
                header("Location: login_seller.php");
                exit(0);
            } 
            else
            {
                $_SESSION['status'] = "Verification Failled.!";
                header("Location: login_seller.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email Already Verifien Please login";
            header("Location: login_seller.php");
            exit(0);
        }
    }

else {
    $_SESSION['status'] = "This Token does not Exists";
    header("Location: login_seller.php");
    exit(0);
}
}

else {
    $_SESSION['status'] = "Not Allowed";
    header("Location: login_seller.php");
    exit(0);
}
?>