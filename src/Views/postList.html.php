<?php
ob_start(); // Start output buffering
?>

<h2>Post List</h2>

<?php if (!empty($posts)) : ?>
    <ul>
        <?php foreach ($posts as $post) : ?>
            <li>
                <h3><?= htmlspecialchars($post->getTitle()) ?></h3>
                <p><?= htmlspecialchars($post->getContent()) ?></p>
                <?php if ($post->getImage()) : ?>
                    <img src="/forum/public/<?= htmlspecialchars($post->getImage()) ?>" alt="Post Image" style="max-width:200px;">
                <?php endif; ?>
                <br>
                <small>Posted by User: <?= htmlspecialchars($post->username) ?></small>
                <a href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>">Edit</a>
                <a href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>


<?php else : ?>
    <p>No posts available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include 'layout.html.php'; // Include the layout
?>
