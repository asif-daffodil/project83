<?php  
    require_once "header.php";
    $pageNo = $_GET['page'] ?? header("Location: all-products.php?page=1");
    $limit = 8;
    $offset = ($pageNo - 1) * $limit;
    $sql = "SELECT * FROM `products` LIMIT $offset, $limit";
    $result = $conn->query($sql);
    $totalProducts = $conn->query("SELECT * FROM `products`")->num_rows;
    $totalPages = ceil($totalProducts / $limit);
    $products = $result->fetch_all(MYSQLI_ASSOC);
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center my-3 text-uppercase display-6">
                All Products
            </div>
            <?php  
                foreach($products as $product){
            ?> 
                <div class="col-md-3 p-3">
                    <div class="card">
                        <img src="uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="card-img-top p-3" style="height: 200px; object-fit: contain">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text">
                                Price: 
                                <s><?= $product['regular_price'] ?></s>
                                <?= $product['sale_price'] ?>
                            </p>
                            <a href="single-product.php?pid=<?= $product['id'] ?>" class="btn btn-dark">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="btn btn-success">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- pagination -->
            <div class="col-md-12 text-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $pageNo == 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="all-products.php?page=<?= $pageNo - 1 ?>">Previous</a>
                        </li>
                        <?php  
                            for($i = 1; $i <= $totalPages; $i++){
                        ?>
                            <li class="page-item <?= $pageNo == $i ? 'active' : '' ?>">
                                <a class="page-link" href="all-products.php?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?= $pageNo == $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="all-products.php?page=<?= $pageNo + 1 ?>">Next</a>
                        </li>   
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
<?php  
    require_once "footer.php";
?>
    