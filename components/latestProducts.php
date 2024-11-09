<?php
$products = $conn->query("SELECT * FROM products ORDER BY id DESC LIMIT 0, 8")->fetch_all(MYSQLI_ASSOC);
?>
<div class="row">
    <h2 class="text-center my-3">Latest Products</h2>
    <?php foreach ($products as $product): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 p-3">
            <div class="card text-center shadow">
                <img src="./uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="card-img-top mx-auto my-4" style="height: 140px; object-fit: cover; width: max-content">
                <div class="card-body">
                    <a href="./single-product.php?pid=<?= $product['id'] ?>" class="text-decoration-none">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                    </a>
                    <p class="card-text">
                        BDT <?= $product['sale_price'] ?>
                        <span class="text-decoration-line-through small text-muted">BDT <?= $product['regular_price'] ?></span>
                    </p>
                    <a href="#" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- view all button -->
    <div class="col-12 text-center my-5">
        <a href="all-products.php" class="btn border border-3 border-primary px-5 py-3 rounded-pill shadow btn-outline-primary">View All</a>
    </div>

</div>