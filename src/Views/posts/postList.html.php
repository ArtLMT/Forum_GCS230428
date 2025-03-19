<?php
ob_start(); // Start output buffering

use src\dal\implementations\UserDAOImpl;

$userDAO = new UserDAOImpl(); // Create an instance of UserDAOImpl
?>

<?php if (!empty($posts)) : ?>
    <div>
        <?php foreach ($posts as $post) : ?>
            <div class="post">
                <div class="post-header">
                    <div>
                        <h2><?= htmlspecialchars($post->getTitle()) ?></h2>
                        <h3>
                            <?php 
                                $username = $userDAO->getUsername($post->getUserId()); 
                                echo htmlspecialchars($username);
                            ?>
                        </h3>
                    </div>
                </div>

                <div class="post-content">
                    <p><?= htmlspecialchars($post->getContent()) ?></p>
                    <?php if ($post->getPostImage()) : ?>
                        <img src="/forum/public/<?= htmlspecialchars($post->getPostImage()) ?>" alt="Post Image" style="max-width:200px;">
                    <?php endif; ?>
                </div>

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
include dirname(__DIR__) . '/layouts/layout.html.php'; // Include the layout
?>
