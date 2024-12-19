<?php
include './connection.php';
$categories = $cn->query("SELECT * FROM `categories`");
function get_content()
{
    ob_start();
    $cn = mysqli_connect('localhost', 'root', '', 'project83');
    if (isset($_POST['addProduct'])) {
        function safeData ($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        $name = $cn->real_escape_string(safeData($_POST['name']));
        $regular_price = $cn->real_escape_string(safeData($_POST['regular_price']));
        $sale_price = $cn->real_escape_string(safeData($_POST['sale_price']));
        $category = $cn->real_escape_string(safeData($_POST['category']));
        $description = $cn->real_escape_string(string: safeData($_POST['description']));
        $stocks = $cn->real_escape_string(safeData($_POST['stocks']));
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        if(empty($name)){
            $errName = "Please fill the name";
        }else{
            $crrName = $name;
        }
    
        if(empty($regular_price)){
            $errRegular_price = "Please fill the regular price";
        }else{
            $crrRegular_price = $regular_price;
        }
    
        if(empty($sale_price)){
            $errSale_price = "Please fill the sale price";
        }else{
            $crrSale_price = $sale_price;
        }
    
        if(empty($category)){
            $errCategory = "Please fill the category";
        }else{
            $crrCategory = $category;
        }
    
        if(empty($description)){
            $errDescription = "Please fill the description";
        }else{
            $crrDescription = $description;
        }
    
        if(empty($stocks)){
            $errStocks = "Please fill the stocks";
        }else{
            $crrStocks = $stocks;
        }
    
        if(empty($image)){
            $errImage = "Please fill the image";
        }
    
        // create new image name
        $image = time() . $image;
        if(!empty($crrName) && !empty($crrRegular_price) && !empty($crrSale_price) && !empty($crrCategory) && !empty($crrDescription) && !empty($image) && !empty($crrStocks)){
            $query = "INSERT INTO `products` (`name`, `regular_price`, `sale_price`, `category_id`, `description`, `stocks`, `image`) VALUES ('$name', $regular_price, $sale_price, '$category', '$description', $stocks, '$image')";
            $cn->query($query);
            move_uploaded_file($tmp_name, "../uploads/$image");
            echo "<script>setTimeout(() => { toastr.success('Product added successfully') }, 1000); setTimeout(() => { window.location.href = 'all-product.php' }, 2000);</script>";
        }
    }

?>
    <h2>Add Product</h2>
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="mb-2">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control <?= isset($errName) ? 'is-invalid' : '' ?>" value="<?= $crrName ?? null ?>">
                    <div class="invalid-feedback">
                        <?= $errName ?? null ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="regular_price" class="mb-2">Regular Price</label>
                    <input type="number" name="regular_price" id="regular_price" class="form-control <?= isset($errRegular_price) ? 'is-invalid' : '' ?>" value="<?= $crrRegular_price ?? null ?>">
                    <div class="invalid-feedback">
                        <?= $errRegular_price ?? null ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sale_price" class="mb-2">Sale Price</label>
                    <input type="number" name="sale_price" id="sale_price" class="form-control <?= isset($errSale_price) ? 'is-invalid' : '' ?>" value="<?= $crrSale_price ?? null ?>">
                    <div class="invalid-feedback">
                        <?= $errSale_price ?? null ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="category" class="mb-2">Category</label>
                    <select name="category" id="category" class="form-select <?= isset($errCategory) ? 'is-invalid' : '' ?>">
                        <option value="">Select Category</option>
                        <?php
                        global $categories;
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category['id'] ?>" <?= isset($crrCategory) ? "selected":null ?> ><?php echo $category['name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $errCategory ?? null ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="mb-2">Description</label>
                    <textarea name="description" id="description" class="form-control <?= isset($errDescription) ? 'is-invalid' : '' ?>">
                        <?= $crrDescription ?? null ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $errDescription ?? null ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stocks" class="mb-2">Stocks</label>
                    <input type="number" name="stocks" id="stocks" class="form-control <?= isset($errStocks) ? 'is-invalid' : '' ?>" value="<?= $crrStocks ?? null ?>">
                    <div class="invalid-feedback">
                        <?= $errStocks ?? null ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="mb-2">Image</label>
                    <input type="file" name="image" id="image" class="form-control <?= isset($errImage) ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $errImage ?? null ?>
                    </div>
                </div>
                <button class="btn btn-primary" name="addProduct">Add Product</button>
            </form>
        </div>
        <div class="col-md-6 d-flex">
            <label for="image" class="m-auto">
                <img src="https://via.placeholder.com/300x300?text=Upload%20Image" alt="Product Image" class="img-fluid" id="productImag" style="max-height: 400px">
            </label>
        </div>
    </div>

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

            document.querySelector('#image').addEventListener('change', function(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = function(e){
                    document.querySelector('#productImag').src = e.target.result;
                }
                reader.readAsDataURL(file);
            });
        </script>
<?php
    return ob_get_clean();
}

$content = get_content();
require_once './layout.php';
?>