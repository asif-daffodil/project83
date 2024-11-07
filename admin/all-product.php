<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
        }
    }
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<?php
function get_content()
{
    require_once './connection.php';
    if (isset($_POST['updateProduct'])) {
        $id = $_POST['id'];
        $name = $cn->real_escape_string($_POST['name']);
        $regular_price = $cn->real_escape_string($_POST['regular_price']);
        $sale_price = $cn->real_escape_string($_POST['sale_price']);
        $category = $cn->real_escape_string($_POST['category']);
        $description = $cn->real_escape_string($_POST['description']);
        $oldImg = $cn->real_escape_string($_POST['oldImg']);
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        if (!empty($name) && !empty($regular_price) && !empty($sale_price) && !empty($category) && !empty($description)) {
            if (!empty($image)) {
                unlink("../uploads/$oldImg");
                $image = time() . $image;
                move_uploaded_file($tmp_name, "../uploads/$image");
                $cn->query("UPDATE products SET name = '$name', regular_price = $regular_price, sale_price = $sale_price, category = '$category', description = '$description', image = '$image' WHERE id = $id");
            } else {
                $cn->query("UPDATE products SET name = '$name', regular_price = $regular_price, sale_price = $sale_price, category = '$category', description = '$description' WHERE id = $id");
            }
            echo "<script>setTimeout(() => { toastr.success('Product updated successfully') }, 1000); setTimeout(() => { window.location.href = 'all-product.php' }, 2000);</script>";
        } else {
            echo "<script>setTimeout(() => { toastr.error('Please fill all the fields') }, 1000);</script>";
        }
    }

    if (isset($_POST['deleteProduct'])) {
        $id = $_POST['id'];
        $product = $cn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
        unlink("../uploads/" . $product['image']);
        $cn->query("DELETE FROM products WHERE id = $id");
        echo "<script>setTimeout(() => { toastr.success('Product deleted successfully') }, 1000); setTimeout(() => { window.location.href = 'all-product.php' }, 2000);</script>";
    }

    $products = $cn->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC);
    ob_start();
?>
    <h2><?= !isset($_GET['eid']) && !isset($_GET['did']) ? "All Products" : (isset($_GET['eid']) ? "Update Product" : "Delete Product") ?></h2>
    <?php if (!isset($_GET['eid']) && !isset($_GET['did'])) { ?>
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr valign="middle">
                        <td></td>
                        <td><img src="../uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" style="height: 80px;"></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['sale_price'] ?></td>
                        <td><?= $product['category'] ?></td>
                        <td>
                            <a href="all-product.php?eid=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="all-product.php?did=<?= $product['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } elseif (isset($_GET['eid'])) {
        $id = $_GET['eid'];
        $product = $cn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
    ?>
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="oldImg" value="<?= $product['image'] ?>">
                    <div class="mb-3">
                        <label for="name" class="mb-2">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="regular_price" class="mb-2">Regular Price</label>
                        <input type="number" name="regular_price" id="regular_price" class="form-control" value="<?= $product['regular_price'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="sale_price" class="mb-2">Sale Price</label>
                        <input type="number" name="sale_price" id="sale_price" class="form-control" value="<?= $product['sale_price'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="mb-2">Category</label>
                        <input type="text" name="category" id="category" class="form-control" value="<?= $product['category'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="mb-2">Description</label>
                        <textarea name="description" id="description" class="form-control"><?= $product['description'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="mb-2">Image</label>
                        <input type="file" name="image" id="image" class="form-control" onchange="document.getElementById('productImag').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="updateProduct" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex">
                <label for="image" class="m-auto">
                    <img src="../uploads/<?= $product['image'] ?>" alt="Product Image" class="img-fluid" id="productImag" style="max-height: 400px">
                </label>
            </div>
        </div>
    <?php } elseif (isset($_GET['did'])) { ?>
        <div class="row">
            <div class="col-md-6">
                <h3>Are you sure you want to delete this product?</h3>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $_GET['did'] ?>">
                    <button type="submit" name="deleteProduct" class="btn btn-danger">Delete Product</button>
                    <a href="./all-product.php" class="btn btn-success">No</a>
                </form>
            </div>
        </div>

    <?php } ?>
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
        lengthMenu: [5, 10, 20],
        order: [0, 'desc'],
        // add serial number on 1st td
        createdRow: (row, data, dataIndex) => {
            row.cells[0].textContent = dataIndex + 1;
        }
    });
</script>
<?php if(isset($_GET['eid'])){ ?>
<script type="module">
    import {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph
            } from 'ckeditor5';

            ClassicEditor
                .create( document.querySelector( '#description' ), {
                    plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                    toolbar: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                } )
                .then( /* ... */ )
                .catch( /* ... */ );
</script>
<?php } ?>