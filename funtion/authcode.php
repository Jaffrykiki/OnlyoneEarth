<?php
session_start();
include ('../connection/dbcon.php');

if(isset($_POST['login_now_btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $login_query ="SELECT * FROM table_customer WHERE Cus_Email ='$email' AND Cus_Password='$password' LIMIT 1 ";
        $login_query_run = mysqli_query($connection, $login_query);
           
        if(mysqli_num_rows($login_query_run) > 0) 
        {
            $row = mysqli_fetch_array($login_query_run);
          
            if($row['Verify_status'] == "1")
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'Cus_Name' => $row['Cus_Name'],
                    'Cus_Phone' => $row['Cus_Phone'],
                    'Cus_Email' => $row['Cus_Email'],
                ];
                $_SESSION['status'] = "You are Logged In Successfully.";
                header("Location: ../customer/dashboard.php");
                exit(0);
            }
            else 
            {
                    $_SESSION['status'] = "Please Verify your Email Address to Login.";
                    header("Location: ../customer/login.php");
                    exit(0);
            } 

        }
        else
        {
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location: ../customer/login.php");
            exit(0);

        }
    }
    else
    {
        $_SESSION['status'] = "All fields are Mandetory";
        header("Location: ../customer/login.php");
        exit(0);
    }


}
else if(isset($_POST['login_seller_btn']))
{
    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
    {
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $login_query ="SELECT * FROM table_seller WHERE S_Email ='$email' AND S_Password='$password' LIMIT 1 ";
        $login_query_run = mysqli_query($connection, $login_query);
           
      
        if(mysqli_num_rows($login_query_run) > 0) 
        {
            $row = mysqli_fetch_array($login_query_run);
          
            if($row['Verify_status'] == "1")
            {
                $_SESSION['authenticated_seller'] = TRUE;
                $_SESSION['auth_seller'] = [
                    'S_Name' => $row['S_Name'],
                    'S_phone' => $row['S_phone'],
                    'S_Email' => $row['S_Email'],
                ];
                $_SESSION['status'] = "You are Logged In Successfully.";
                header("Location: ../seller/dashboard_seller.php");
                exit(0);
            }
            else 
            {
                    $_SESSION['status'] = "Please Verify your Email Address to Login.";
                    header("Location:../seller/login_seller.php");
                    exit(0);
            } 

        }
        else
        {
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location:../seller/login_seller.php");
            exit(0);

        }
    }
    else
    {
        $_SESSION['status'] = "All fields are Mandetory";
        header("Location:../seller/login_seller.php");
        exit(0);
    }


}
else if (isset($_POST['login_admin_btn']))
    {
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);

        $login_query ="SELECT * FROM table_admin WHERE A_Email ='$email' AND A_Password='$password' ";
        $login_query_run = mysqli_query($connection, $login_query);
           
        echo $login_query;
        if(mysqli_num_rows($login_query_run) > 0) 
        {
            $_SESSION['authenticated_admin'] = TRUE;

            $userdata = mysqli_fetch_array($login_query_run);
            $username = $userdata['A_Name'];
            $useremail = $userdata['A_Email'];

                $_SESSION['auth_admin'] = [
                    'A_Name' => $username,
                    'A_Email' => $useremail
                ];

                $_SESSION['status'] = 
                header("Location: ../admin/dashboard.php");
                 
        }
        else
        {
            $_SESSION['status'] = "Invalid Email or Password";
            header("Location: ../admin/index.php");

        }
    }
