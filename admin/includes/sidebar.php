<?php   
// ดึงชื่อไฟล์ของหน้าปัจจุบัน (ตัดส่วนหลัง /)
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>
<!-- ส่วนของ Sidebar -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="index.php">
      <span class="ms-1 font-weight-bold text-white">Admin Dashboard</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <!-- เริ่มต้นส่วนของเมนูใน Sidebar -->
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "index.php"? 'bg-gradient-primary':''; ?>" href="index.php">
         <!-- ไอคอนและข้อความเมนู -->
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
            <li class="nav-item">
        <a class="nav-link text-white <?= $page == "manage_users.php"? 'bg-gradient-primary':''; ?>" href="manage_users.php">
        <!-- ไอคอนและข้อความเมนู -->
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">จัดการผู้ใช้</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "category.php"? 'bg-gradient-primary':''; ?>" href="category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">category</i>
          </div>
          <span class="nav-link-text ms-1">หมวดหมู่ทั้งหมด</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "add-category.php"? 'bg-gradient-primary':''; ?> " href="add-category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">add</i>
          </div>
          <span class="nav-link-text ms-1">เพิ่มหมวดหมู่สินค้า</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "products.php"? 'bg-gradient-primary':''; ?>" href="products.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">สินค้าทั้งหมด</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "add-product.php"? 'bg-gradient-primary':''; ?>" href="add-product.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">add_shopping_cart</i>
          </div>
          <span class="nav-link-text ms-1">เพิ่มสินค้า</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?= $page == "orders.php"? 'bg-gradient-primary':''; ?>" href="orders.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">ออเดอร์</span>
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