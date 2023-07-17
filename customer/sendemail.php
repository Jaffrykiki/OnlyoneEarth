<?php
session_start();
include('../connection/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP        
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication     

    $mail->Host       = "smtp.gmail.com";                       //Set the SMTP server to send through
    $mail->Username   = "jaffry8426@gmail.com";                 //SMTP username
    $mail->Password   = "qsljbprcliuhwqoz";                      //SMTP password

    $mail->SMTPSecure = "tls";                                  //Enable implicit TLS encryption
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('jaffry8426@gmail.com', $name);
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verify From Only One Earth';

    $email_template = "
        <h2>Login and register in Only One Earth</h2>
        <h5>Verify your email address to Login with the below given link </h5>
        <br/><br/>
        <a href = 'http://localhost/OnlyoneEarth/verify-email.php?token=$verify_token' >Click me </a>
    ";

    $mail->Body    = $email_template;
    $mail->send();
    // echo 'Message has been sent';

}
//สมัครในส่วนของผู้ซื้อ
if (isset($_POST['register_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    //Email Exists or not 
    $check_email_query = "SELECT Cus_Email FROM table_customer WHERE Cus_Email='$email' LIMIT 1 ";
    $check_email_query_run = mysqli_query($connection, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email Id already Exists";
        header("Location:register.php");
    } else {

        // Insert User / Registered User data 
        $query = "INSERT INTO `table_customer`(`Cus_Name`,`Cus_Phone`,`Cus_Email`,`Cus_Password`,`Verify_token`) VALUES (' $name','$phone','$email','$password','$verify_token')";
        $query_run = mysqli_query($connection, $query);
        echo $query_run;

        if ($query_run) {
            sendemail_verify("$name", "$email", "$verify_token");

            $_SESSION['status'] = "Registration SuccessFull.! Please verify your Email Address";
            header("Location: register.php");
        } else {
            $_SESSION['status'] = "Registration Failed";
            header("Location: register.php");
        }
    }
}

//สมัครในส่วนของผู้ขาย

if (isset($_POST['register_seller_btn'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());

    //Email Exists or not 
    $check_email_query = "SELECT S_Email FROM table_seller WHERE S_Email='$email' LIMIT 1 ";
    $check_email_query_run = mysqli_query($connection, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email Id already Exists";
        header("Location:register_seller.php");
    } else {

        // Insert User / Registered User data 
        $query = "INSERT INTO `table_seller`(`S_Name`,`S_phone`,`S_Email`,`S_Password`,`Verify_token`) VALUES (' $name','$phone','$email','$password','$verify_token')";
        $query_run = mysqli_query($connection, $query);
        echo $query_run;

        if ($query_run) {
            sendemail_verify("$name", "$email", "$verify_token");

            $_SESSION['status'] = "Registration SuccessFull.! Please verify your Email Address";
            header("Location: register_seller.php");
        } else {
            $_SESSION['status'] = "Registration Failed";
            header("Location: register_seller.php");
        }
    }
}
