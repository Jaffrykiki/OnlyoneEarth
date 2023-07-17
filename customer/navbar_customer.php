<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php if (isset($page_title)) {
      echo "$page_title";
    } ?>
  </title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="js/bootstrap.min.js">
  <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
  <div class="bg-success">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
              <a class="navbar-brand"><a class="navbar-brand" href="index.php">
                  <img src="image/Logo.png" alt="" width="100" height="100">
                </a>Only one Earth </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" href="../index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../seller/login_seller.php">Seller</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                  </li>
                  <?php if (!isset($_SESSION['authenticated'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="register.php">register</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="login.php">login</a>
                    </li>
                  <?php endif ?>
                  <?php if (isset($_SESSION['authenticated'])) : ?>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">logout</a>
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