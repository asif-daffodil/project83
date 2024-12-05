<?php  
  $pageName = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="./">E-Commerce-83</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= $pageName == "index.php"?  "active":null ?>" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $pageName == "all-products.php"?  "active":null ?>" href="./all-products.php">Shop</a>
        </li>
        <?php if(!isset($_SESSION['user'])){ ?>
            <li class="nav-item">
            <a class="nav-link" href="./signin.php">Sign In</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./signup.php">Sign Up</a>
            </li>
        <?php }else{ ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            My Account
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./update-profile.php">Update Profile</a></li>
            <li><a class="dropdown-item" href="./profile-picture.php">Profile Picture</a></li>
            <li><a class="dropdown-item" href="./change-password.php">Change Password</a></li>
            <?php if($_SESSION['user']['role'] == 'admin'){ ?>
              <li><a class="dropdown-item" href="./admin">Admin Panel</a></li>
            <?php } ?>
            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>
          </ul>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="./contact.php">Contact</a>
        </li>
        <!-- cart icon -->
        <li class="nav-item me-2">
          <button class="nav-link position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge bg-primary position-absolute top-0 start-100 translate-middle-x" id="cartCount">0</span>
          </button>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./search.php">
            <i class="fas fa-search"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasRightLabel">Offcanvas right</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    ...
  </div>
</div>