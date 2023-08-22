<!-- สร้าง Navbar ด้วย class ของ Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-success shadow">
  <!-- แท็ก <ul> เป็นรายการของ Nav Links ทางซ้าย -->
  <ul class="navbar-nav ms-auto">
    <!-- แท็ก <ul> เป็นรายการของ Nav Links ทางซ้าย -->
    <li class="nav-item">
      <a class="nav-link active" href="register_seller.php">เริ่มต้นเป็นผู้ขาย</a>
    </li>
  </ul>
  <!-- ใช้ <div> เป็นคอนเทนเนอร์สำหรับแท็ก Navbar Brand และปุ่ม Navbar Toggler -->
  <div class="container">
    <style>
      .navbar-brand img {
        max-width: 80px;
        /* ปรับขนาดตามที่คุณต้องการ */
        height: auto;
        /* จะทำให้รูปภาพปรับสัดส่วน */
      }
    </style>

    <!-- แท็ก <a> แสดง Navbar Brand -->
    <a class="navbar-brand" href="index.php">
      <img src="uploads/logo_transparent.png" alt="Only One Earth Logo">Only One Earth
    </a>
    <!-- แท็ก <a> แสดง Navbar Brand -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- เมนู Navigation Links ที่แสดงเมื่อเปิด Navbar Toggler -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <!-- แสดง Nav Item สำหรับหน้าแรก -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">หน้าแรก</a>
        </li>
        <!-- แสดง Nav Item สำหรับหมวดหมู่สินค้า -->
        <li class="nav-item">
          <a class="nav-link" href="categories.php">หมวดหมู่สินค้า</a>
        </li>
        <!-- แสดง Nav Item สำหรับหน้าตะกร้าสินค้า -->
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i></a>
        </li>
        <!-- แสดง Nav Item สำหรับหน้าตะกร้าสินค้า -->
        <?php
        if (isset($_SESSION['auth'])) {
        ?>
          <!-- แสดง Nav Item สำหรับผู้ใช้ที่ล็อกอินแล้ว -->
          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <!-- แสดงรูปภาพผู้ใช้ -->
              <img src="<?= isset($_SESSION['login_id']) ? $_SESSION['auth_user']['img'] : "uploads/" . $_SESSION['auth_user']['img'] ?>" alt="" class="user-profile-image" style="border-radius:50%;" width="35" height="35">
              <!-- แสดงชื่อผู้ใช้ -->
              <?= $_SESSION['auth_user']['name']; ?>
            </a>
            <!-- เมนู Dropdown สำหรับผู้ใช้ที่ล็อกอินแล้ว -->
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="profile.php">บัญชีของฉัน</a></li>
              <li><a class="dropdown-item" href="my-orders.php">การซื้อของฉัน</a></li>
              <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
            </ul>
          </li>
        <?php
        } else {
        ?>
          <!-- แสดง Nav Item สำหรับผู้ใช้ที่ยังไม่ได้ล็อกอิน -->
          <li class="nav-item">
            <a class="nav-link" href="register.php">สมัครสมาชิก</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">เข้าสู่ระบบ</a>
          </li>
        <?php
        }
        ?>


      </ul>
    </div>
  </div>
</nav>