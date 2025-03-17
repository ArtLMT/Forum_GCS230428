<?php 
ob_start(); // Start output buffering
?>
<h1>This is profile page</h1>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include 'layout.html.php'; // Include the layout
?>