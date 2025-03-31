<?php
ob_start(); // Start output buffering

use src\dal\implementations\UserDAOImpl;

$userDAO = new UserDAOImpl(); // Create an instance of UserDAOImpl
?>
<div class="w-2/3 mx-auto">
    <?php if (!empty($posts)) : ?>
        <div class="mt-[2%]">
            <?php foreach ($posts as $post) : ?>
                <?php 
                    $user = $userDAO->getUserById($post->getUserId());
                    $userImage = $user->getUserImage();
                    $username = $userDAO->getUsername($post->getUserId());
                    $firstLetter = strtoupper(substr($username, 0, 1)); // Get first letter and make it uppercase
                ?>
                <div class="post bg-slate-900 border-solid border-2 rounded-lg border-gray-600 hover:border-gray-300 duration-700 ease-in-out transform hover:scale-105">
                    <div class="post-header flex p-3">
                        <a class="size-[60px] flex items-center justify-center bg-gray-500 text-white rounded-full text-4xl font-bold" href="/forum/public/showProfile?id=<?=$post->getUserId()?>">
                            <?php if ($userImage) : ?>
                                <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-[60px] rounded-full object-cover" alt="User Profile">
                            <?php else : ?>
                                <?= $firstLetter ?>
                            <?php endif; ?>
                        </a>
                        <div class='ml-3'>
                            <h3 class="text-base">
                                <?= htmlspecialchars($username); ?>
                                
                                <?= htmlspecialchars($post->getTimestamp()) ?>
                            </h3>
                            <h2 class="m-0 text-3xl leading-1"><?= htmlspecialchars($post->getTitle()) ?></h2>
                        </div>
                    </div>
                    <hr class="min-w-[85%] place-self-center">

                    <div class="post-content">
                        <p class= "mx-[5rem] my-[1rem] truncate w-96"><?= htmlspecialchars($post->getContent())?></p>
                        <?php if ($post->getPostImage()) : ?>
                            <img class="m-auto object-cover max-w-[900px] max-h-[600px]" src="/forum/public/<?= htmlspecialchars($post->getPostImage()) ?>" alt="Post Image">
                        <?php endif; ?>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>No posts available.</p>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean(); // Store the buffered output into $content
include dirname(__DIR__) . '/layouts/layout.html.php'; // Include the layout
?>
