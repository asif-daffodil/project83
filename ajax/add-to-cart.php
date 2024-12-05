<?php  
    if(isset($_POST['pid'])){
        require_once "../db/db.php";
        $pid = $conn->real_escape_string($_POST['pid']);
        $query = "SELECT * FROM `products` WHERE `id` = $pid";
        $result = $conn->query($query);
        $product = $result->fetch_assoc();
        echo json_encode($product);
    }
?>