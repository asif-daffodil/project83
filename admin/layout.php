<?php
require_once './header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 min-vh-100 text-bg-dark">
            <?php require_once './sidebar.php' ?>
        </div>
        <div class="col-md-10 p-0">
            <?php require_once './navbar.php' ?>
            <div class="p-4">
                <?= $content ?? null ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once './footer.php';
?>