<?php
require_once '../db/db.php';
if (isset($_POST['cart'])) {
    $cart = $_POST['cart'];
    $cartItems = [];
    $totalPrice = 0;
    foreach ($cart as $item) {
        $pid = $item['id'];
        $product = $conn->query("SELECT * FROM products WHERE id = $pid")->fetch_assoc();
        $cartItems[] = $product;
    }
    foreach ($cartItems as $i => $item) {
?>
        <div class="row border-bottom bg-light rounded shadow py-3">
            <!-- product image -->
            <div class="col-3">
                <img src="./uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="height: 100px; object-fit: contain">
            </div>
            <!-- sell prise -->
            <div class="col-3 d-flex flex-column justify-content-center align-items-start">
                <h6><?= $item['name'] ?></h6>
                <p class="text-muted m-0 p-0">Price: $<?= $item['sale_price'] ?></p>
            </div>
            <!-- quantity -->
            <div class="col-2 d-flex flex-column align-items-center">
                <button class="btn btn-sm btn-secondary" onclick="decreaseQty(<?= $item['id'] ?>)">-</button>
                <span class="mx-2"><?= $cart[$i]['qty'] ?></span>
                <button class="btn btn-sm btn-secondary" onclick="increaseQty(<?= $item['id'] ?>)">+</button>
            </div>
            <!-- Total price sell price x quantity -->
            <div class="col-2 d-flex flex-column justify-content-center align-items-start">
                <p class="m-0 p-0">Total: $<?= $item['sale_price'] * $cart[$i]['qty'] ?></p>
                <?php $totalPrice += $item['sale_price'] * $cart[$i]['qty'] ?>
            </div>
            <!-- remove from cart -->
            <div class="col-2 d-flex flex-column justify-content-center align-items-start">
                <button class="btn btn-sm btn-danger" onclick="removeFromCart(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
            </div>
        </div>
<?php
    }
}
?>
<!-- Total Price -->
<div class="row bg-light rounded shadow">
    <div class="col-12 d-flex justify-content-end py-3">
        <h6>Total Price: <?= $totalPrice ?? Null ?></h6>
    </div>
</div>