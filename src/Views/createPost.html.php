<?php
ob_start(); // Start output buffering
?>

<h2>Create Post</h2>

<form action="/ForumTest/public/create" method="post">
    <label>Title:</label>
    <input type="text" name="title" required><br>
    
    <label>Content:</label>
    <textarea name="content" required></textarea><br>
    
    <label>User ID:</label>
    <input type="number" name="user_id" required><br>
    
    <label>Module ID:</label>
    <input type="number" name="module_id" required><br>
    
    <input type="submit" value="Create Post">
</form>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include 'layout.html.php'; // Include the layout file to render the page
?>
