<?php  
    $conn = mysqli_connect("localhost","root","","project83");

    function safe($data){
        global $conn;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }
?>