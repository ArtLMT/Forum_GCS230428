<?php
ob_start(); // Start output buffering
?>

<h2 class="text-center ">Create Post</h2>

<form action="/forum/public/createPost" method="post" enctype="multipart/form-data">
    <label>Title:</label>
    <input class="text-gray-700" type="text" name="title" required><br>
    
    <label>Content:</label>
    <textarea class="text-gray-700" name="content" required></textarea><br>
    
    <label>User ID:</label>
    <input class="text-gray-700" type="number" name="user_id" required><br>
    
    <!-- <label>Module ID:</label>
    <input type="number" name="module_id" required><br> -->
    <select class="text-black"name="module_id" required>
    <option class="text-black" value="">Select a Module</option>
        <?php foreach ($modules as $module): ?>
            <option value="<?= $module->getModuleId() ?>"><?= htmlspecialchars($module->getModuleName()) ?></option>
        <?php endforeach; ?>
    </select><br>
    
    <label>Image:</label>
    <input type="file" name="image"><br>
    
    <input type="submit" value="Create Post">
</form>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php';
?>
