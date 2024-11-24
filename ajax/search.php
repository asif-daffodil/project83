<?php  
    require_once "../db/db.php";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $products = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode($products);
        }else{
            echo json_encode([]);
        }
    }
?>