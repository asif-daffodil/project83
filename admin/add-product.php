<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css" />
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
        }
    }
</script>

<?php

if (isset($_POST['addProduct'])) {
    require_once './connection.php';
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
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    // create new image name
    $image = time() . $image;
    if(!empty($name) && !empty($regular_price) && !empty($sale_price) && !empty($category) && !empty($description) && !empty($image)){
        $query = "INSERT INTO `products` (`name`, `regular_price`, `sale_price`, `category`, `description`, `image`) VALUES ('$name', $regular_price, $sale_price, '$category', '$description', '$image')";
        $cn->query($query);
        move_uploaded_file($tmp_name, "../uploads/$image");
        echo "<script>setTimeout(() => { toastr.success('Product added successfully') }, 1000); setTimeout(() => { window.location.href = 'all-product.php' }, 2000);</script>";
    }else{
        echo "<script>setTimeout(() => { toastr.error('Please fill all the fields') }, 1000);</script>";
    }
}

function get_content()
{
    ob_start();
?>
    <h2>Add Product</h2>
    <div class="row">
        <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="mb-2">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="regular_price" class="mb-2">Regular Price</label>
                    <input type="number" name="regular_price" id="regular_price" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sale_price" class="mb-2">Sale Price</label>
                    <input type="number" name="sale_price" id="sale_price" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category" class="mb-2">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="Electronics">Electronics</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Grocery">Grocery</option>
                        <option value="Appliances">Appliances</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="mb-2">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="mb-2">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
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