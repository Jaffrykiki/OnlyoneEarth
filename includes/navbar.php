<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow">
  <ul class="navbar-nav ms-auto">
    <li class="nav-item">
      <a class="nav-link active" href="register_seller.php">เริ่มต้นเป็นผู้ขาย</a>
    </li>
  </ul>
  <div class="container">
    <a class="navbar-brand" href="index.php">Only One Earth</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="categories.php">หมวดหมู่สินค้า</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart fa-1x" aria-hidden="true"></i></a>
        </li>
        <?php
        if (isset($_SESSION['auth'])) {
        ?>
          <li class="nav-item dropdown " >
            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['auth_user']['name']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
            </ul>
          </li>
        <?php
        } else {
        ?>
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