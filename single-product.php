<?php  
    require_once "./header.php";
    $pid = $_GET['pid'] ?? header("Location: index.php");
    $product = $conn->query("SELECT * FROM products WHERE id = $pid");
    $product->num_rows == 0 && header("Location: index.php");
    $product = $product->fetch_assoc();
?>
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-6 text-center py-5">
                <img src="./uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid" style="height: 250px">
            </div>
            <div class="col-lg-6">
                <h2 class="display-4"><?= $product['name'] ?></h2>
                <p class="lead">BDT <?= $product['sale_price'] ?></p>
                <p><?= htmlspecialchars_decode($product['description']) ?></p>
                <a href="#" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>
        <!-- Random 4 products card -->
        <?php
            $products = $conn->query("SELECT * FROM products WHERE id != $pid ORDER BY RAND() LIMIT 0, 4")->fetch_all(MYSQLI_ASSOC);
        ?>
        <div class="row">
            <h2 class="text-center my-3">You May Also Like</h2>
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
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php  
    require_once "./footer.php";
?>