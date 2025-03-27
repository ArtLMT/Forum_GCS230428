<?php
ob_start(); // Start output buffering

use src\dal\implementations\UserDAOImpl;

$userDAO = new UserDAOImpl(); // Create an instance of UserDAOImpl
?>

<?php if (!empty($posts)) : ?>
    <div>
        <?php foreach ($posts as $post) : ?>
            <div class="post bg-slate-900 border-solid border-2 rounded-lg border-green-700">
                <div class="post-header flex p-2">
                    <p class="flex-[1] bg-white rounded-full max-h-11 max-w-11"></p>
                    <div class='flex-[19]'>
                        <h3 class="ml-2 text-xs">
                            <?php
                            // htmlspecialchars($userDAO->getUsername($post->getUserId()));
                            $username = $userDAO->getUsername($post->getUserId()); 
                            echo htmlspecialchars($username);
                            ?>
                            
                            <!-- <?= htmlspecialchars($post->getTimestamp()) ?> -->
                        </h3>
                        <h2 class="ml-2 text-xl"><?= htmlspecialchars($post->getTitle()) ?></h2>
                    </div>
                </div>

                <div class="post-content">
                    <p class= "mr-[4rem] ml-[4rem] mt-[1rem] mb-[1rem]"><?= htmlspecialchars($post->getContent())?></p>
                    <?php if ($post->getPostImage()) : ?>
                        <!-- <?php var_dump($post->getPostImage()); ?> -->
                        <img class="m-auto" src="/forum/public/<?= htmlspecialchars($post->getPostImage()) ?>" alt="Post Image" style="max-width:200px;">
                    <?php endif; ?>
                </div>

                <div class="flex gap-4 justify-end text-center mr-5 mb-[1rem] mt-[1rem]">
                    <a class="bg-green-400 border-solid border-green-700 border-2 p-1 w-14 text-xs" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>">Edit</a>
                    <a class="bg-red-400 border-solid border-red-500 border-2 p-1 w-14 text-xs" href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
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
