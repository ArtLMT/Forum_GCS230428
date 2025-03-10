<?php
$title = 'Forum testing';
ob_start();
include './src/Views/homepage.html.php';
$output = ob_get_clean();
include './src/Views/layout.html.php';
?>