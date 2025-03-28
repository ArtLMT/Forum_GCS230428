<?php
ob_start();
?>
<h2>Update Post</h2>
<?php if(isset($post) && $post !== null ) : ?>
    <form action="/forum/public/update" method="post" enctype="multipart/form-data">
        <!-- Hidden field for post ID -->
        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getPostId()) ?>">

        <label>Title:</label>
        <input class="text-gray-700" type="text" name="title" value="<?= htmlspecialchars($post->getTitle()) ?>" required><br>

        <label>Content:</label>
        <textarea class="text-gray-700" name="content" required><?= htmlspecialchars($post->getContent()) ?></textarea><br>

        <label>Module ID:</label>
        <input class="text-gray-700" type="number" name="module_id" value="<?=$post->getModuleId() ?>" required><br>

        <!-- Display current image (if exists) -->
        <?php if ($post->getPostImage()) : ?>
            <p>Current Image:</p>
            <img src="/forum/public/<?=$post->getPostImage()?>" alt="Current Image">
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
<?php else: ?>
    <p>Error: post not found</p>
<?php endif; ?>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php';
?>
