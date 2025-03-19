<?php
ob_start(); // Start output buffering
?>

<form action="/forum/public/createModule" method="post">
    <label>Module Name:</label>
    <input type="text" name="module_name" required><br>
    
    <label>Module Description:</label>
    <textarea name="module_description" required></textarea><br>
    
    <input type="submit" value="Create Module">
</form>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout file to render the page
?>
