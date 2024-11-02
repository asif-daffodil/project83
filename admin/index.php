<?php  
function get_content() {
    if (true) { 
        ob_start(); 
        ?>
        <h2>Dashboard</h2>
        <p>Welcome to the admin dashboard.</p>
        <?php
        return ob_get_clean();
    }
}
?>

<?php 
$content = get_content();

require_once './layout.php'; 
?>
