<?php
// ดึงชื่อไฟล์ของหน้าปัจจุบัน (ตัดส่วนหลัง /)
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>
<!-- ส่วนของ Sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-info" id="sidenav-main">
  <div class="sidenav-header">
    <!-- ไอคอนสำหรับปิดเมนูด้านข้าง -->
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="index.php">
      <i class="fa fa-users mr-2 text-white"></i> <!-- เพิ่มไอคอนในนี้ -->
      <span class="ms-1 font-weight-bold text-white">Admin Dashboard</span>
      <h5>สวัสดี:<?= $_SESSION['auth_user']['name']; ?> <img src="<?= "../uploads/". $_SESSION['auth_user']['img'] ?>" alt="" class="user-profile-image" style="border-radius:50%;" width="35" height="35"></h5>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <!-- เริ่มต้นส่วนของเมนูใน Sidebar -->
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "index.php" ? 'bg-gradient-warning' : ''; ?>" href="index.php">
          <!-- ไอคอนและข้อความเมนู -->
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">แดชบอร์ด</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "manage_users.php" ? 'bg-gradient-warning' : ''; ?>" href="manage_users.php">
          <!-- ไอคอนและข้อความเมนู -->
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">account_circle</i>
          </div>
          <span class="nav-link-text ms-1">จัดการผู้ใช้</span>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white <?= in_array($page, ["category.php", "add-category.php"]) ? 'bg-gradient-warning' : ''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">format_list_bulleted</i>
          </div>
          <span class="nav-link-text ms-1">จัดการหมวดหมู่สินค้า</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item <?= $page == "category.php" ? 'active' : ''; ?>" href="category.php">หมวดหมู่ทั้งหมด</a></li>
          <li><a class="dropdown-item <?= $page == "add-category.php" ? 'active' : ''; ?>" href="add-category.php">เพิ่มหมวดหมู่สินค้า</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white <?= in_array($page, ["products.php", "add-product.php"]) ? 'bg-gradient-warning' : ''; ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">format_list_bulleted</i>
          </div>
          <span class="nav-link-text ms-1">จัดการสินค้า</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item <?= $page == "products.php" ? 'active' : ''; ?>" href="products.php">สินค้าทั้งหมด</a></li>
          <li><a class="dropdown-item <?= $page == "add-product.php" ? 'active' : ''; ?>" href="add-product.php">เพิ่มสินค้า</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "orders.php" ? 'bg-gradient-warning' : ''; ?>" href="orders.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">view_list</i>
          </div>
          <span class="nav-link-text ms-1">ออเดอร์</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "report.php" ? 'bg-gradient-warning' : ''; ?>" href="report.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">report</i>
          </div>
          <span class="nav-link-text ms-1">คำร้องจากผู้ใช้</span>
        </a>
      </li>
      <!-- จบส่วนของเมนูใน Sidebar -->
    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
    <div class="mx-3">
      <a class="btn bg-gradient-primary mt-4 w-100" href="../logout.php">
        ออกจากระบบ
      </a>
    </div>
  </div>
</aside>
<!-- จบส่วนของ Sidebar -->