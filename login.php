<?php
session_start();

include('includes/header.php');
include('connection/dbcon.php');

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบอยู่หรือไม่
if (isset($_SESSION['auth'])) {
    header('location: index.php');
}

require 'google-api/vendor/autoload.php';

// สร้างอินสแตนซ์ของ Google Client
$client = new Google_Client();

// กำหนด Client ID
$client->setClientId('228571355522-v5ft31amc6llqu45u3nscaugqp0hulca.apps.googleusercontent.com');
// กำหนด Client Secret
$client->setClientSecret('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');
// กำหนด Redirect URL
$client->setRedirectUri('http://localhost/OnlyoneEarth/login.php');

// เพิ่มขอบเขตของข้อมูลที่ต้องการ (email และ profile Information)
$client->addScope("email");
$client->addScope("profile");

// ตรวจสอบว่ามีการรับรหัสสำหรับอนุญาติผ่าน Google หรือไม่
if (isset($_GET['code'])) :

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token["error"])) {

        // กำหนด Access Token ให้กับ Client
        $client->setAccessToken($token['access_token']);

        // รับข้อมูลโปรไฟล์ผู้ใช้จาก Google
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // สำหรับการจัดเก็บข้อมูลลงในฐานข้อมูล
        $id = mysqli_real_escape_string($connection, $google_account_info->id);
        $full_name = mysqli_real_escape_string($connection, trim($google_account_info->name));
        $email = mysqli_real_escape_string($connection, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($connection, $google_account_info->picture);

         // ตรวจสอบว่ามีผู้ใช้อยู่แล้วหรือไม่
        $get_user = mysqli_query($connection, "SELECT * FROM `users` WHERE `google_id`='$id'");
        if (mysqli_num_rows($get_user) > 0) {

            // หากมีบัญชีในระบบ
            $_SESSION['auth'] = true;

            // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
            $userdate = mysqli_fetch_array($get_user);
            $users_id = $userdate['id'];
            echo "true";
            echo "\n " . $users_id;

            // เก็บข้อมูลผู้ใช้ในเซสชัน
            $_SESSION['login_id'] = $id;
            $_SESSION['auth_user'] = [
                'id' => $users_id,
                'name' => $full_name,
                'email' => $email,
                'img' => $profile_pic
            ];

            // ไปยังหน้าหลักหลังจากเข้าสู่ระบบ
            header('Location: index.php');
            exit;
        } else {

            // หากผู้ใช้ยังไม่มีบัญชี
            $insert = mysqli_query($connection, "INSERT INTO `users` ( `google_id`, `name`, `email`, `phone`, `password`, `verify_token`, `verify_status`, `role_as`, `img`, `created_at`) VALUES ( '$id', '$full_name', '$email', '', '', '', '0', '0', '$profile_pic', current_timestamp())");

            if ($insert) {
                // ดึง ID ที่ถูกสร้างใหม่ 
                $users_id = mysqli_insert_id($connection);

                // เก็บข้อมูลผู้ใช้ในเซสชัน
                $_SESSION['login_id'] = $id;
                $_SESSION['auth_user'] = [
                    'id' => $users_id,
                    'name' => $full_name,
                    'email' => $email,
                    'img' => $profile_pic
                ];

                // ไปยังหน้าหลักหลังจากการสร้างบัญชี
                header('Location: index.php');
                exit;
            } else {
                echo "Sign up failed!(Something went wrong).";
            }
        }
    } else {
        header('Location: login.php');
        exit;
    }
else :
    
?>

    <!-- ส่วนของการแสดงผลแบบฟอร์มเข้าสู่ระบบ -->
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <?php
                    // ตรวจสอบว่ามีข้อความเซสชันเก็บไว้หรือไม่ ถ้ามีให้แสดงข้อความแจ้งเตือน
                    if (isset($_SESSION['message'])) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Status:</strong> <?= $_SESSION['message']; ?>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                        // เคลียร์ข้อความเซสชันหลังจากแสดงผลแล้ว
                        unset($_SESSION['message']);
                    }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>เข้าสู่ระบบ</h4>
                        </div>
                        <div class="card-body">
                            <!-- แบบฟอร์มสำหรับกรอกข้อมูลเข้าสู่ระบบ -->
                            <form action="funtion/authcode.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">อีเมล์</label>
                                    <input type="email" required name="email" class="form-control" placeholder="ป้อนอีเมล์ของคุณ" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">รหัสผ่าน</label>
                                    <input type="password" required name="password" class="form-control" placeholder="ป้อนรหัสผ่านของคุณ" id="exampleInputPassword1">
                                </div>
                                <button type="submit" name="login_btn" class="btn btn-success ">เข้าสู่ระบบ</button>
                                <!-- Register buttons -->
                                <div class="text-center mb-2">
                                    <p>เพิ่งเคยเข้ามาใน Only One Earth ใช่หรือไม่? </p>
                                    <a href="register.php" class="btn btn-secondary">สมัครใหม่</a>
                                    <p>หรือล็อกอินด้วย:</p>
                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </button>
                                    <a type="button" class="login-with-google-btn" href="<?php echo $client->createAuthUrl(); ?>">
                                        <i class="fa fa-google"></i>
                                    </a>
                                </div>
                            </form>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="index.php" class="btn btn-warning">กลับไปหน้าหลัก</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php endif; ?>
<?php include('includes/footer.php'); ?>