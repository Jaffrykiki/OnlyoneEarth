<?php
session_start();

include('../connection/dbcon.php');
include('../funtion/myfunction.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//Load Composer's autoloader
require '../vendor/autoload.php';

//SendEmail_verify
function sendemail_verify($name,$email,$verify_token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'jaffry8426@gmail.com';
    $mail->Password   = 'oeopsrzbqwfycrpj';

    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    $mail->setFrom('jaffry8426@gmail.com', $name);
    $mail->addAddress($email); 

    $mail->isHTML(true); 
    $mail->Subject = 'Email verification From Only One Earth';

    $email_templace =" 
    <h2>คุณได้ลงทะเบียนกับ Only One Earth</h2>
    <h5>ยืนยันที่อยู่อีเมลของคุณเพื่อเข้าสู่ระบบด้วยลิงค์ด้านล่าง</h5>
    <br/><br/>
    <a href='http://localhost/onlyoneearth/funtion/verify-email.php?token=$verify_token'> คลิ๊กที่นี้ </a>
    ";



    $mail->Body    = $email_templace;
    $mail->send();
    echo 'ส่งข้อความแล้ว';
}


//สมัครสมาชิกทั่วไป
if (isset($_POST['register_btn'])) 
{
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);

    //ตรวจสอบว่าอีเมลลงทะเบียนแล้วหรือไม่
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($connection, $check_email_query);
    
    if (mysqli_num_rows($check_email_query_run) >0 ) 
    {
        $_SESSION['message'] = "อีเมล์ของท่านเคยทำการลงทะเบียนแล้ว";
        header('Location: ../register.php');
    } 
    else 
    {    
        if ($password == $cpassword) 
        {
            //insert user date 
            $insert_query = "INSERT INTO users (name,email,phone,password) VALUE ('$name','$email','$phone','$password')";
            $insert_query_run = mysqli_query($connection, $insert_query);

            if ($insert_query_run) {
                $_SESSION['message'] = "สมัครสมาชิกสำเร็จ";
                header('Location: ../login.php');
            } else {
                $_SESSION['message'] = "มีบางอย่างผิดพลาด";
                header('Location: ../login.php');
            }
        } 
        else 
        {
            $_SESSION['message'] = "รหัสผ่านไม่ตรงกัน";
            header('Location: ../register.php');
        }
    }
}
//สมัครผู้ขาย
else if (isset($_POST['register_seller_btn'])) 
{
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    $verify_token = md5(rand());


    //ตรวจสอบว่าอีเมลลงทะเบียนแล้วหรือไม่
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($connection, $check_email_query);
    
    if (mysqli_num_rows($check_email_query_run) >0 ) 
    {
        $_SESSION['message'] = "อีเมล์ของท่านเคยทำการลงทะเบียนแล้ว";
        header('Location: ../register.php');
    } 
    else 
    {    
        if ($password == $cpassword) 
        {
            //insert user date 
            $insert_query = "INSERT INTO users (name,email,phone,password,verify_token,role_as) VALUE ('$name','$email','$phone','$password','$verify_token','2')";
            $insert_query_run = mysqli_query($connection, $insert_query);
            
            echo $insert_query_run;

            if ($insert_query_run) 
            {
                sendemail_verify("$name","$email","$verify_token");

                $_SESSION['message'] = "ลงทะเบียนเรียบร้อยแล้ว โปรดยืนยันการลงทะเบียนผ่านอีเมล์อีกครั้ง";
                header('Location: ../register_seller.php');
            } 
            else 
            {
                $_SESSION['message'] = "มีบางอย่างผิดพลาด";
                header('Location: ../register_seller.php');
            }
        } 
        else 
        {
            $_SESSION['message'] = "รหัสผ่านไม่ตรงกัน";
            header('Location: ../register.php');
        }
    }
}
//ล็อกอิน
else if(isset($_POST['login_btn'])) 
{
    $email = mysqli_real_escape_string($connection , $_POST['email']);
    $password = mysqli_real_escape_string($connection , $_POST['password']);


    //queryข้อมูลจากฐานข้อมูล
    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run = mysqli_query($connection, $login_query);

    if(mysqli_num_rows($login_query_run) > 0 )
    {
        $_SESSION['auth'] = true;

        $userdate = mysqli_fetch_array($login_query_run); 
        $username = $userdate['name'];
        $useremail = $userdate['email'];
        $users_id = $userdate['id'];
        $role_as = $userdate['role_as'];
        $verify_status = $userdate['verify_status'];

        $_SESSION['auth_user'] =[
            'name' => $username,
            'emmail' => $username,
            'id' => $users_id
        ];
        
        //เช็คบทบาทของการเข้าสู่ระบบ
        $_SESSION['role_as'] = $role_as;
        if ($role_as == 0) {
            $_SESSION['message'] = 
            redirect("../index.php" ,"ยินดีต้อนรับเข้าสู่ระบบ");
        }
        else if($role_as == 1)
        {
            $_SESSION['message'] = 
            redirect("../admin/index.php","ยินดีต้อนรับเข้าสู่แดชบอร์ด");
        } else  {
            $_SESSION['verify_status'] = $verify_status;
        
            if($verify_status == 1)
            {
                $_SESSION['message'] = 
                redirect("../seller/index.php","ยินดีต้อนรับเข้าสู่แดชบอร์ด");
            }
            else  
            {
                $_SESSION['message'] = 
                redirect("../index.php" ,"ยินดีต้อนรับเข้าสู่ระบบ");
            }
        }
    }
    else
        {
            //ไม่เข้าเงื่อนไขด้านบน
        $_SESSION['message'] = "";
        redirect("../login.php" ,"ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
        }
}
?>