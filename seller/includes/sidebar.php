<?php   
  // รับค่าชื่อไฟล์ปัจจุบัน
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>
<!-- เริ่มต้นส่วนของเมนูด้านข้าง -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-warning" id="sidenav-main">
<div class="sidenav-header">
    <!-- ไอคอนสำหรับปิดเมนูด้านข้าง -->
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="index.php">
      <i class="fa fa-users mr-2 text-white"></i> <!-- เพิ่มไอคอนในนี้ -->
      <span class="ms-1 font-weight-bold text-white">Seller Dashboard</span>
      <h5>สวัสดี:<?= $_SESSION['auth_user']['name']; ?> <img src="<?= "../uploads/". $_SESSION['auth_user']['img'] ?>" alt="" class="user-profile-image" style="border-radius:50%;" width="35" height="35"></h5>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "index.php"? 'bg-gradient-info':''; ?>" href="index.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">แดชบอร์ด</span>
        </a>
      </li>
      <li class="nav-item">
        <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "products.php"? 'bg-gradient-info':''; ?> " href="products.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">สินค้าทั้งหมด</span>
        </a>
      </li>
      <li class="nav-item">
        <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "add-product.php"? 'bg-gradient-info':''; ?>" href="add-product.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">add_shopping_cart</i>
          </div>
          <span class="nav-link-text ms-1">เพิ่มสินค้า</span>
        </a>
      </li>
            <li class="nav-item">
              <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "orders.php"? 'bg-gradient-info':''; ?>" href="orders.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">ออเดอร์</span>
        </a>
      </li>
      <li class="nav-item">
              <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "warn.php"? 'bg-gradient-info':''; ?>" href="warn.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">แจ้งเตือน</span>
        </a>
      </li>
      <li class="nav-item">
              <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "withdraw.php"? 'bg-gradient-info':''; ?>" href="withdraw.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">ทำเรื่องถอนเงิน</span>
        </a>
      </li>
      <li class="nav-item">
              <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
        <a class="nav-link text-white <?= $page == "hiswithdraw.php"? 'bg-gradient-info':''; ?>" href="hiswithdraw.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">ประวัติการถอนเงิน</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
      <!-- ลิงก์แบบมีการเปลี่ยนสีพื้นหลังของเมนูเมื่ออยู่ที่หน้านั้น ๆ -->
      <a class="btn bg-gradient-primary mt-4 w-100" href="../logout.php">
        ออกจากระบบ
      </a>
    </div>
  </div>
</aside>
<!-- สิ้นสุดส่วนของเมนูด้านข้าง -->