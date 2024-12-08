<?php
function get_content()
{
    ob_start();
?>
    <h2>Categories</h2>
    <p>Welcome to the admin categories.</p>
<?php
    return ob_get_clean();
}

$content = get_content();
require_once './layout.php';
?>