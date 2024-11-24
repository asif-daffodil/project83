<?php
require_once "header.php";
?>
<div class="container my-5">
    <h2 class="display-4 text-center mb-3">Search</h2>
    <div class="row py-5">
        <div class="col-lg-6 mx-auto border rounded shadow p-5">
            <form action="" method="get">
                <div class="mb-3">
                    <label for="search" class="form-label">Search your product</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="..." autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary" name="search123">
                    <i class="fas fa-search"></i>
                    Search
                </button>
            </form>
        </div>
    </div>
    <?php if (isset($_GET['search123'])) { ?>
        <div class="row mb-5 d-flex justify-content-center">
            <?php
            $search = urldecode($_GET['search']);

            $search = safe($search);

            // Add wildcards for partial matching in the query
            $searchTerm = "%$search%";

            // Prepare the SQL query using prepared statements
            $stmt = $conn->prepare("SELECT * FROM `products` WHERE `name` LIKE ?");

            // Bind the search term to the query
            $stmt->bind_param("s", $searchTerm);

            // Execute the query
            $stmt->execute();

            // Get the result of the query
            $result = $stmt->get_result();

            // Check if any products were found
            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-3">
                        <div class="card overflow-hidden">
                            <img src="./uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="card-img-top border-bottom py-3 overflow-hidden" style="height: 200px; object-fit: contain; transition: transform 0.3s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h5>
                                <p class="card-text">
                                    Price:
                                    <s><?= htmlspecialchars($product['regular_price'], ENT_QUOTES, 'UTF-8') ?></s>
                                    <?= htmlspecialchars($product['sale_price'], ENT_QUOTES, 'UTF-8') ?>
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
                <?php }
            } else { ?>
                <div class="col-md-6">
                    <div class="alert alert-danger">
                        No products found for "<?= htmlspecialchars($_GET['search'], ENT_QUOTES, 'UTF-8') ?>"
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php } ?>
    <script>
        $("#search").on("keyup", function() {
            let search = $(this).val();
            if (search.length > 0) {
                $.ajax({
                    url: "./ajax/search.php",
                    method: "post",
                    data: {
                        search: search
                    },
                    success: function(data) {
                        let products = JSON.parse(data);
                        let suggestions = products.map(product => product.name);
                        $("#search").autocomplete({
                            source: suggestions
                        });
                    }
                });
            }
        });
    </script>

    <?php
    require_once "footer.php";
    ?>