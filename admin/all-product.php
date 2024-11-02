<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<?php  
    function get_content() {
        require_once './connection.php';
        $products = $cn->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC);
        ob_start();
        ?>
        <h2>All Products</h2>
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product): ?>
                    <tr valign="middle">
                        <td><?= $product['id'] ?></td>
                        <td><img src="../uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" style="height: 80px;"></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['sale_price'] ?></td>
                        <td><?= $product['category'] ?></td>
                        <td>
                            <a href="edit-product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete-product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        return ob_get_clean();
    }
?>
<?php
    $content = get_content();
    require_once './layout.php';
?>
<script>
    let table = new DataTable('#myTable', {
        lengthMenu : [5, 10, 20, ]
    });
</script>