<?php
require_once '../db/db.php';
if (isset($_POST['cart'])) {
    $cart = $_POST['cart'];
    $cartItems = [];
    foreach ($cart as $item) {
        $pid = $item['id'];
        $product = $conn->query("SELECT * FROM products WHERE id = $pid")->fetch_assoc();
        $cartItems[] = $product;
    }
    foreach ($cartItems as $i => $item) {
?>
        <div class="row border-bottom py-3">
            <div class="col-3">
                <img src="./uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="height: 100px; object-fit: contain">
            </div>
            <div class="col-5 d-flex flex-column justify-content-center align-items-start">
                <h6><?= $item['name'] ?></h6>
                <p class="text-muted m-0 p-0">Price: $<?= $item['sale_price'] ?></p>
            </div>
            <div class="col-2 d-flex flex-column align-items-center">
                <button class="btn btn-sm btn-secondary" onclick="decreaseQty(<?= $item['id'] ?>)">-</button>
                <span class="mx-2"><?= $cart[$i]['qty'] ?></span>
                <button class="btn btn-sm btn-secondary" onclick="increaseQty(<?= $item['id'] ?>)">+</button>
            </div>
            <div class="col-2 d-flex flex-column justify-content-center align-items-start">
                <button class="btn btn-sm btn-danger" onclick="removeFromCart(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
<?php
    }
}
?>