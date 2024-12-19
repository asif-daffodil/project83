<?php  
    require_once '../connection.php';
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
    }

    if(isset($_POST['editId'])){
        $id = $cn->real_escape_string($_POST['id']);
        $result = $cn->query("SELECT * FROM `categories` WHERE `id` = $id");
        $data = $result->fetch_assoc();
        echo json_encode($data);
    }

    if(isset($_POST['editCategory'])){
        $id = $cn->real_escape_string($_POST['id']);
        $name = $cn->real_escape_string($_POST['name']);
        if (!empty($name)) {
            if($cn->query("UPDATE `categories` SET `name` = '$name' WHERE `id` = $id")){
                echo "success";
            }else{
                echo "failed";
            }
            
        } else {
            echo "Please fill all the fields";
        }
    }

    if (isset($_POST['deleteCategory'])) {
        $id = $cn->real_escape_string($_POST['id']);
        if($cn->query("DELETE FROM `categories` WHERE `id` = $id")){
            echo "success";
        }else{
            echo "failed";
        }
    }
?>