<?php
require_once "header.php";
if (!isset($_SESSION['user'])) {
    echo "<script>window.location = 'signin.php'</script>";
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            
        </div>
        <div class="col-md-6" id="products">

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        if (localStorage.getItem('ghaziCart')) {
            let cart = JSON.parse(localStorage.getItem('ghaziCart'));
            $.post('ajax/cart-list.php', {
                cart
            }, (data) => {
                $('#products').html(data);
            });
        }
    })
</script>
<?php
require_once "footer.php";
?>