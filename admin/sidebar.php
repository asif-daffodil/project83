<?php  
    $pageName = basename($_SERVER['PHP_SELF']);
?>
<h3 class="py-2">Ghazi Shop</h3>
<nav class="navbar-dark">
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= $pageName == "index.php" ? "active":null ?>" href="./index.php">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex dd" data-bs-toggle="collapse" href="#product" role="button" aria-expanded="<?= $pageName == "all-product.php" || $pageName == "add-product.php" ? "true":"false" ?>" aria-controls="product">Product <span class="ms-auto"><i class="fa-solid fa-chevron-down"></i></span></a>
            <div class="collapse bg-dark <?= $pageName == "all-product.php" || $pageName == "add-product.php" ? "show":null ?>" id="product">
                <div class="card card-body bg-dark">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="./all-product.php" class="nav-link <?= $pageName == "all-product.php" ? "active":null ?>">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a href="./add-product.php" class="nav-link <?= $pageName == "add-product.php" ? "active":null ?>">Add Product</a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
    </ul>
</nav>