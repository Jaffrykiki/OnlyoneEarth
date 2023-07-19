<?php 
session_start();

if(isset($_SESSION['auth']))
{
    $_SESSION['message'] = "คุณเข้าสู่ระบบแล้ว";
    header('Location:index.php');
}


include('includes/header.php'); 
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php 
                if (isset($_SESSION['message'])) 
                {  
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Status:</strong> <?= $_SESSION['message']; ?>.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                }
                    ?>
                <div class="card">
                    <div class="card-header">
                        <h4>แบบฟอร์มสมัครสมาชิก</h4>
                    </div>
                    <div class="card-body">
                        <form action="funtion/authcode.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="ป้อนชื่อที่คุณต้องการสร้าง">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="phone" name="phone" class="form-control" placeholder="ป้อนเบอร์โทรศัพท์">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="ป้อนอีเมล์ของคุณ" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="ป้อนรหัสผ่านที่คุณต้องการสร้าง" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="ยืนยันรหัสของคุณอีกครั้ง">
                            </div>
                            <button type="submit" name="register_btn" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>