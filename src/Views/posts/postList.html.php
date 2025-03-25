<?php
ob_start(); // Start output buffering

use src\dal\implementations\UserDAOImpl;

$userDAO = new UserDAOImpl(); // Create an instance of UserDAOImpl
?>

<?php if (!empty($posts)) : ?>
    <div>
        <?php foreach ($posts as $post) : ?>
            <div class="post border-solid border-2">
                <div class="post-header">
                    <div>
                        <h2 class="text-center"><?= htmlspecialchars($post->getTitle()) ?></h2>
                        <h3>
                            <?php
                            //  htmlspecialchars($userDAO->getUsername($post->getUserId()));
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

                <div class="flex gap-4 justify-end text-center">
                    <a class="bg-green-400 border-solid border-green-500 border-2 p-2 w-20" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>">Edit</a>
                    <a class="bg-red-400 border-solid border-red-500 border-2 p-2 w-20" href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No posts available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include dirname(__DIR__) . '/layouts/layout.html.php'; // Include the layout
?>
