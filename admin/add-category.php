<?php  
    require_once './connection.php';
    if (isset($_POST['addCategory'])) {
        $name = $cn->real_escape_string($_POST['name']);
        if (!empty($name)) {
            if($cn->query("INSERT INTO `categories` (`name`) VALUES ('$name')")){
                echo "success";
            }else{
                echo "failed";
            }
            
        } else {
            echo "Please fill all the fields";
        }
    }else{
        echo json_encode($_POST);
    }
?>