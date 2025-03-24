<?php
ob_start();
?>
<h2>Update Post</h2>
<form action="/forum/public/update" method="post" enctype="multipart/form-data">
    <!-- Hidden field for post ID -->
    <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getPostId()) ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required><br>

    <label>Content:</label>
    <textarea name="content" required><?= htmlspecialchars($post->getContent()) ?></textarea><br>

    <label>Module ID:</label>
    <input type="number" name="module_id" value="<?= htmlspecialchars($post->getModuleId()) ?>" required><br>

    <!-- Display current image (if exists) -->
    <?php if ($post->getPostImage()) : ?>
        <p>Current Image:</p>
        <img src="/forum/public/<?= htmlspecialchars($post->getPostImage())?>" alt="Current Image" style="max-width:200px;">
        <br>
        <!-- Option to remove image -->
        <label>
            <input type="checkbox" name="remove_image" value="1">
            Remove this image
        </label>
        <br>
    <?php endif; ?>

    <label>Upload New Image (optional):</label>
    <input type="file" name="image"><br>

    <input type="submit" value="Update Post">
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php';
?>
