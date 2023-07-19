<?php
session_start();

include('../connection/dbcon.php');

if (isset($_POST['register_btn'])) 
{
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);

    //check if email already registered
    $check_email_query = "SELECT COUNT(email) FROM users WHERE email='$email' > 0";
    $check_email_query_run = mysqli_query($connection, $check_email_query);

    if ($check_email_query_run > 0) 
    {
        $_SESSION['message'] = "อีเมล์ของท่านเคยทำการลงทะเบียนแล้ว";
        header('Location: ../register.php');
    } 
    else 
    {    
        if ($password == $cpassword) 
        {
            //insert user date 
            $insert_query = "INSERT INTO users (name,email,phone,password) VALUE ('$name',' $email','$phone','$password')";
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
else if(isset($_POST['login_btn'])) 
{
    $email = mysqli_real_escape_string($connection , $_POST['email']);
    $password = mysqli_real_escape_string($connection , $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run = mysqli_query($connection, $login_query);

    if(mysqli_num_rows($login_query_run) > 0 )
    {
        $_SESSION['auth'] = true;

        $userdate = mysqli_fetch_array($login_query_run); 
        $username = $userdate['name'];
        $useremail = $userdate['email'];

        $_SESSION['auth_user'] = [
            'name' => $username,
            'email' => $useremail
        ];

        $_SESSION['message']= "เข้าสู่ระบบสำเร็จ";
        header('Location: ../index.php');
    }
    else
    {
        $_SESSION['message'] = "ข้อมูลไม่ถูกต้อง";
        header('Location: ../login.php');
    }

}
?>
