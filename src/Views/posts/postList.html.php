<?php
ob_start(); // Start output buffering

use src\dal\implementations\UserDAOImpl;

$userDAO = new UserDAOImpl(); // Create an instance of UserDAOImpl
?>

<?php if (!empty($posts)) : ?>
    <div>
        <?php foreach ($posts as $post) : ?>
            <div class="post border-solid border-2 rounded-lg">
                <div class="post-header">
                    <div>
                        <h2 class="text-center text-2xl"><?= htmlspecialchars($post->getTitle()) ?></h2>
                        <h3 class="text-center text-xs"> By
                            <?php
                            // htmlspecialchars($userDAO->getUsername($post->getUserId()));
                                $username = $userDAO->getUsername($post->getUserId()); 
                                echo htmlspecialchars($username);
                            ?>
                            at
                            <?= htmlspecialchars($post->getTimestamp()) ?>
                        </h3>
                    </div>
                </div>
                <div class="post-content">
                    <p class= "mr-[4rem] ml-[4rem] mt-[2rem] mb-[1rem]"><?= htmlspecialchars($post->getContent()) ?></p>
                    <?php if ($post->getPostImage()) : ?>
                        <img class="m-auto"src="/forum/public/<?= htmlspecialchars($post->getPostImage()) ?>" alt="Post Image" style="max-width:2000px;">
                    <?php endif; ?>
                </div>

                <div class="flex gap-4 justify-end text-center mr-5 mb-[1rem]">
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
