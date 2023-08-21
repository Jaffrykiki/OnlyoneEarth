<?php


include('../connection/dbcon.php');
include('../funtion/myfunction.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// ใช้ Composer's autoloader เพื่อโหลดคลาสที่ต้องการ
require '../vendor/autoload.php';

// ฟังก์ชันสำหรับการส่งอีเมล์ยืนยันการลงทะเบียน
function sendemail_verify($name,$email,$verify_token)
{

    // สร้างอ็อบเจ็กต์สำหรับส่งอีเมล์
    $mail = new PHPMailer(true); 
    $mail->isSMTP();
    $mail->SMTPAuth   = true;

    // ตั้งค่า SMTP สำหรับ Gmail
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'jaffry8426@gmail.com';
    $mail->Password   = 'oeopsrzbqwfycrpj';
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    // ตั้งค่าผู้ส่งและผู้รับ
    $mail->setFrom('jaffry8426@gmail.com', $name);
    $mail->addAddress($email); 

    $mail->isHTML(true);  // ตั้งค่าให้เนื้อหาเป็น HTML
    $mail->Subject = 'Email verification From Only One Earth';

    // สร้างเนื้อหาอีเมล์
    $email_templace =" 
    <h2>คุณได้ลงทะเบียนกับ Only One Earth</h2>
    <h5>ยืนยันที่อยู่อีเมลของคุณเพื่อเข้าสู่ระบบด้วยลิงค์ด้านล่าง</h5>
    <br/><br/>
    <a href='http://localhost/onlyoneearth/funtion/verify-email.php?token=$verify_token'> คลิ๊กที่นี้ เพื่อยืนยันการลงทะเบียน </a>
    ";


    // สร้างเนื้อหาอีเมล์        
    $mail->Body    = $email_templace;

    // ส่งอีเมล์
    $mail->send();
    echo 'ส่งข้อความแล้ว';
}


// กรณีที่ผู้ใช้กดปุ่ม "สมัครสมาชิกทั่วไป"
if (isset($_POST['register_btn'])) 
{
   // รับข้อมูลจากฟอร์มและเก็บไว้ในตัวแปร
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);

    // ตรวจสอบว่าอีเมลลงทะเบียนแล้วหรือไม่
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($connection, $check_email_query);
    
    // ถ้ามีอีเมล์ในระบบแล้ว
    if (mysqli_num_rows($check_email_query_run) >0 ) 
    {
        // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางกลับไปยังหน้าลงทะเบียน
        $_SESSION['message'] = "อีเมล์ของท่านเคยทำการลงทะเบียนแล้ว";
        header('Location: ../register.php');
    } 
    // ถ้ายังไม่มีอีเมล์ในระบบ
    else 
    {    
        // เช็ครหัสผ่านว่าตรงกันหรือไม่
        if ($password == $cpassword) 
        {
            // เพิ่มข้อมูลผู้ใช้ในฐานข้อมูล 
            $insert_query = "INSERT INTO users (name,email,phone,password) VALUE ('$name','$email','$phone','$password')";
            $insert_query_run = mysqli_query($connection, $insert_query);

            if ($insert_query_run) {
                // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
                $_SESSION['message'] = "สมัครสมาชิกสำเร็จ";
                header('Location: ../login.php');
            } else {
                // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าเข้าสู่ระบบ
                $_SESSION['message'] = "มีบางอย่างผิดพลาด";
                header('Location: ../login.php');
            }
        } 
        // ถ้ายังไม่มีอีเมล์ในระบบ
        else 
        {
            // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางกลับไปยังหน้าลงทะเบียน
            $_SESSION['message'] = "รหัสผ่านไม่ตรงกัน";
            header('Location: ../register.php');
        }
    }
}
// กรณีที่ผู้ใช้กดปุ่ม "สมัครผู้ขาย"
else if (isset($_POST['register_seller_btn'])) 
{
    // รับข้อมูลจากฟอร์มและเก็บไว้ในตัวแปร
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $cpassword = mysqli_real_escape_string($connection, $_POST['cpassword']);
    $verify_token = md5(rand());


    // ตรวจสอบว่าอีเมลลงทะเบียนแล้วหรือไม่
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run = mysqli_query($connection, $check_email_query);
    
    // ถ้ามีอีเมล์ในระบบแล้ว
    if (mysqli_num_rows($check_email_query_run) >0 ) 
    {
        // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางกลับไปยังหน้าลงทะเบียน
        $_SESSION['message'] = "อีเมล์ของท่านเคยทำการลงทะเบียนแล้ว";
        header('Location: ../register.php');
    } 
    // ถ้ายังไม่มีอีเมล์ในระบบ
    else 
    {    
        // เช็ครหัสผ่านว่าตรงกันหรือไม่
        if ($password == $cpassword) 
        {
            // เพิ่มข้อมูลผู้ใช้ในฐานข้อมูล 
            $insert_query = "INSERT INTO users (name,email,phone,password,verify_token,role_as) VALUE ('$name','$email','$phone','$password','$verify_token','2')";
            $insert_query_run = mysqli_query($connection, $insert_query);
            
            // เรียกใช้ฟังก์ชันส่งอีเมล์ยืนยัน
            if ($insert_query_run) 
            {
                sendemail_verify("$name","$email","$verify_token");

                // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าลงทะเบียนผู้ขาย
                $_SESSION['message'] = "ลงทะเบียนเรียบร้อยแล้ว โปรดยืนยันการลงทะเบียนผ่านอีเมล์อีกครั้ง";
                header('Location: ../register_seller.php');
            } 
            else 
            {
               // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าลงทะเบียนผู้ขาย
                $_SESSION['message'] = "มีบางอย่างผิดพลาด";
                header('Location: ../register_seller.php');
            }
        } 
        // ถ้ารหัสผ่านไม่ตรงกัน
        else 
        {
            // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางกลับไปยังหน้าลงทะเบียน
            $_SESSION['message'] = "รหัสผ่านไม่ตรงกัน";
            header('Location: ../register.php');
        }
    }
}

// กรณีที่ผู้ใช้กดปุ่ม "เข้าสู่ระบบ"
else if(isset($_POST['login_btn'])) 
{
    // ดึงข้อมูลจากฟอร์มและค้นหาในฐานข้อมูล
    $email = mysqli_real_escape_string($connection , $_POST['email']);
    $password = mysqli_real_escape_string($connection , $_POST['password']);


    // คำสั่ง SQL สำหรับการเรียกข้อมูลผู้ใช้จากฐานข้อมูล
    $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
    $login_query_run = mysqli_query($connection, $login_query);

    // ถ้าพบข้อมูลผู้ใช้ที่ตรงกับในระบบ
    if(mysqli_num_rows($login_query_run) > 0 )
    {
        // เซ็ตตัวแปรเซสชันสำหรับเช็คการเข้าสู่ระบบ
        $_SESSION['auth'] = true;

        // ดึงข้อมูลผู้ใช้จากการค้นหาในฐานข้อมูล
        $userdate = mysqli_fetch_array($login_query_run); 
        $username = $userdate['name'];
        $useremail = $userdate['email'];
        $users_id = $userdate['id'];
        $role_as = $userdate['role_as'];
        $verify_status = $userdate['verify_status'];
        $img =$userdate['img'];

        // เก็บข้อมูลผู้ใช้ในเซสชัน
        $_SESSION['auth_user'] =[
            'name' => $username,
            'email' => $useremail,
            'id' => $users_id,
            'img' => $img
        ];
        
        // ตรวจสอบบทบาทของผู้ใช้และเปลี่ยนเส้นทางตาม
        $_SESSION['role_as'] = $role_as;
        if ($role_as == 0) {
            // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าหลัก
            $_SESSION['message'] = 
            redirect("../index.php" ,"ยินดีต้อนรับเข้าสู่ระบบ");
        }
        else if($role_as == 1) {
            // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าแดชบอร์ดแอดมิน
            $_SESSION['message'] = 
            redirect("../admin/index.php","ยินดีต้อนรับเข้าสู่แดชบอร์ด");
        } else  {
            $_SESSION['verify_status'] = $verify_status;
            if($verify_status == 1) {
                // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าแดชบอร์ดขาย
                $_SESSION['message'] = 
                redirect("../seller/index.php","ยินดีต้อนรับเข้าสู่แดชบอร์ด");
            }
            else  
            {
                $_SESSION['message'] = 
                // แสดงข้อความแจ้งเตือนและเปลี่ยนเส้นทางไปยังหน้าหลัก
                redirect("../index.php" ,"ยินดีต้อนรับเข้าสู่ระบบ");
            }
        }
    }
    else
        {
           // ไม่พบข้อมูลผู้ใช้ที่ตรงกับในระบบ
        $_SESSION['message'] = "";
        redirect("../login.php" ,"ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
        }
}

// กรณีที่ผู้ใช้กดปุ่ม "แก้ไขข้อมูลส่วนตัว"
else if(isset($_POST['update_profile_btn']))
{
    // รับค่าผู้ใช้และข้อมูลจากแบบฟอร์ม
    $user_id = $_SESSION['auth_user']['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // รับค่าผู้ใช้และข้อมูลจากแบบฟอร์ม
    $path = "../uploads";

    // รับข้อมูลรูปภาพใหม่และเก่า
    $new_image = $_FILES['img']['name'];
    $old_image = $_POST['old_image'];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
    if($new_image != "")
    { 
        // สร้างชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบันเป็นส่วนหนึ่งของชื่อไฟล์
        $image_ext = strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        // ตรวจสอบชนิดของไฟล์รูปภาพ
        $allowed_image_extensions = array("jpeg", "jpg", "png");
        $update_filenname = time().'.'.$image_ext;

        // ตรวจสอบขนาดไฟล์รูปภาพ
        $max_file_size = 1024 * 1024; // 1 MB
    }
    else
    {
        // ถ้าไม่มีการอัปโหลดรูปภาพใหม่ ใช้ชื่อไฟล์เก่า
        $update_filenname = $old_image;
    }
   
    if(in_array($image_ext, $allowed_image_extensions) && $_FILES['img']['size'] <= $max_file_size)
    {
        $update_filename = time() . '.' . $image_ext;
    // สร้างคำสั่ง SQL สำหรับการอัปเดตข้อมูลผู้ใช้
        $update_user_query ="UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone',`img`='$update_filenname' WHERE id ='$user_id'" ;
    // ดำเนินการอัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
        $update_user_query_run = mysqli_query($connection, $update_user_query);

    // ตรวจสอบว่าการอัปเดตสำเร็จหรือไม่
    if ($update_user_query_run) 
    {
        // ถ้ามีการอัปโหลดรูปภาพใหม่ ย้ายไฟล์ไปยังที่เก็บและลบไฟล์เก่า
        if($_FILES['img']['name'] != "")
        {
            move_uploaded_file($_FILES['img']['tmp_name'], $path. '/' .$update_filenname);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        // นำผู้ใช้ไปยังหน้าโปรไฟล์พร้อมข้อความสถานะ
        redirect("../profile.php?id=$user_id", "อัปเดตข้อมูลเรียบร้อยแล้ว");
    }
    else
    {
        // ถ้าการอัปเดตไม่สำเร็จ นำผู้ใช้ไปยังหน้าโปรไฟล์พร้อมข้อความสถานะ
        redirect("../profile.php?id=$user_id", "มีบางอย่างผิดพลาด");
    }
}
    else
    {
    redirect("../profile.php?id=$user_id", "ไฟล์รูปภาพไม่ถูกต้องหรือขนาดเกินกว่า 1 MB");
    }

} 
// กรณีที่ผู้ใช้กดปุ่ม "รายงานเรื่องมายังผู้ดูแลระบบ"
else if(isset($_POST['report_btn']))
{
    // รับค่าผู้ใช้และข้อมูลจากแบบฟอร์ม
    $user_id = $_SESSION['auth_user']['id'];

    $subject = $_POST["subject"];
    $details = $_POST["details"];

    // ข้อมูลของไฟล์รูปภาพ
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $image_size = $_FILES["image"]["size"];
    $image_type = $_FILES["image"]["type"];

    // เช็คประเภทของไฟล์รูปภาพ (ตัวอย่างเช็คว่าเป็นไฟล์รูปภาพเท่านั้น)
    if (strpos($image_type, "image") !== false) {
        // ตั้งค่าที่เก็บไฟล์
        $upload_dir = "../uploads/";
        $upload_path = $upload_dir . $image_name;

        // ข้อมูลเก่าเกี่ยวกับไฟล์รูปภาพ
        $old_image = ''; // ต้องระบุชื่อไฟล์รูปภาพเก่าที่จะถูกลบ

        // เพิ่มข้อมูลเรื่องลงในฐานข้อมูล
        $report_query = "INSERT INTO `reports`( `user_id`, `subject`, `details`, `img`) VALUES ('$user_id','$subject', '$details','$upload_path')";

        // ดำเนินการอัปเดตข้อมูลผู้ใช้ในฐานข้อมูล
        $report_query_run = mysqli_query($connection, $report_query);

        // ตรวจสอบว่าการอัปเดตสำเร็จหรือไม่
        if ($report_query_run) 
        {
            // อัปโหลดไฟล์รูปภาพใหม่
            move_uploaded_file($image_tmp_name, $upload_path);

            // ลบไฟล์รูปภาพเก่า (ถ้ามี)
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }

            // นำผู้ใช้ไปยังหน้าโปรไฟล์พร้อมข้อความสถานะ
            redirect("../help_center.php", "รายงานเรื่องไปยังผู้ดูแลระบบเรียบร้อยแล้ว");
        }
        else
        {
            // ถ้าการอัปเดตไม่สำเร็จ นำผู้ใช้ไปยังหน้าโปรไฟล์พร้อมข้อความสถานะ
            redirect("../help_center.php", "มีบางอย่างผิดพลาด");
        }
    }
    else
    {
        redirect("../help_center.php", "กรุณาแนบไฟล์รูปภาพ");
    }
}
