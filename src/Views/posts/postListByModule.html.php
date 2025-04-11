<?php
ob_start(); // Start output buffering
use src\utils\Utils;
$moduleName =  htmlspecialchars($module->getModuleName());
$title = $moduleName;
?>
<h2 class="text-xl font-bold mb-4">Posts for module: <?= htmlspecialchars($module->getModuleName()) ?></h2>

<?php foreach ($posts as $post) : ?>
                <?php
                    $userImage = $post->getUserImage();
                    $username = $post->getUsername();
                ?>
                <div class="bg-white border-solid border-2 rounded-lg border-indigo-200 hover:border-indigo-500 shadow-md duration-700 ease-in-out transform hover:scale-105">
                    <div class="post-header flex p-3">
                        <a class="size-[60px] flex items-center justify-center bg-indigo-500 text-white rounded-full text-4xl font-bold" href="/forum/public/showProfile?id=<?=$post->getUserId()?>">
                            <?php if ($userImage) : ?>
                                <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-[60px] rounded-full object-cover" alt="User Profile">
                            <?php else : ?>
                                <?= strtoupper(substr($username, 0, 1)) // Get first letter and make it uppercase  ?> 
                            <?php endif; ?>
                        </a>
                        <div class='ml-3'>
                            <h3 class="text-slate-500 text-sm">
                                <?= htmlspecialchars($username); ?>  • <?= htmlspecialchars(Utils::timeAgo($post->getPostedTime())); ?>
                            </h3>
                            <h2 class="m-0 text-3xl text-indigo-700 font-bold"><?= htmlspecialchars($post->getTitle()) ?></h2>
                        </div>
                    </div>
                    <hr class="min-w-[85%] place-self-center">

                    <div class="post-content">
                        <a href="/forum/public/postDetail?post_id=<?= $post->getPostId()?>">
                            <p class= "mx-[5rem] my-[1rem] line-clamp-3 text-slate-700"><?= htmlspecialchars($post->getContent())?></p>
                            <?php if ($post->getPostImage()) : ?>
                                <img class="m-auto mb-[1rem] object-cover max-w-[900px] max-h-[600px] rounded-md shadow-sm" src="/forum/public/<?= htmlspecialchars($post->getPostImage()) ?>" alt="Post Image">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <br>
            <?php endforeach; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>