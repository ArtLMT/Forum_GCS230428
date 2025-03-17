<?php
ob_start(); // Start output buffering
?>

<!-- <h2>Post List</h2> -->

<?php if (!empty($posts)) : ?>
    <div>
        <?php foreach ($posts as $post) : ?>
            <div class="post">
                <div class="post-header">
                <?php if ($post->getImage()) : ?>   
                    <img src="/forum/public/<?= htmlspecialchars($post->getImage()) ?>" alt="Post Image" style="width:40px; height:40px; border-radius: 50%;">
                <?php endif; ?>
                <div>
                    <h2><?= htmlspecialchars($post->getTitle()) ?></h2>
                    <h3><?= htmlspecialchars($post->username)?></h3>
                </div>
                </div>

                <div class="post-content">
                    <p><?= htmlspecialchars($post->getContent()) ?></p>
                    <?php if ($post->getImage()) : ?>
                        <img src="/forum/public/<?= htmlspecialchars($post->getImage()) ?>" alt="Post Image" style="max-width:200px;">
                    <?php endif; ?>
                </div>

                <!-- <small>Posted by User: <?= htmlspecialchars($post->username) ?></small> -->

                <div class="post-footer">

                    <a href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>">Edit</a>
                    <a href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


<?php else : ?>
    <p>No posts available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include 'layout.html.php'; // Include the layout
?>
