<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="js/bootstrap.min.js">
  <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
  <div class="bg-secondary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
              <a class="navbar-brand"><a class="navbar-brand" href="index.php">
                  <!-- <img src="image/Logo.png" alt="" width="80" height="80"> -->
                </a>Seller </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" href="index_seller.php">Home</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="dashboard_seller.php">Dashboard</a>
                  </li>
                  <?php if (!isset($_SESSION['authenticated_seller'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="register_seller.php">register</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="../index.php">Customer</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="login_seller.php">login</a>
                    </li>
                  <?php endif ?>
                  <?php if (isset($_SESSION['authenticated_seller'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="logout_seller.php">logout</a>
                    </li>
                  <?php endif ?>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<?php include('footer.php'); ?>