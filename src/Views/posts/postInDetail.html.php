<?php
ob_start();
use src\controllers\UserController;
use src\controllers\PostController;
use src\utils\Utils;

$title = $postTitle;
?>
<!-- <?php var_dump($userId)?> -->

<div class="post bg-slate-900 border-solid border-2 rounded-lg max-h-[800px]">
    <!-- <div><img src="/forum/public/assets/img/backButton.svg" alt=""></div> -->
    <div class="post-header flex p-3 items-center">
        <a class="relative left-[0.5rem]"href="/forum/public/"><img src="/forum/public/assets/img/backButton.svg" alt=""></a>
        <div class="flex items-center justify-center ml-[1.5rem]">
            <a class="size-[60px] flex items-center justify-center bg-gray-500 text-white rounded-full text-4xl font-bold" href="/forum/public/showProfile?id=<?=$post->getUserId()?>">
                <?php if ($userImage) : ?>
                    <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-[60px] rounded-full object-cover" alt="User Profile">
                <?php else : ?>
                    <?= $firstLetter ?>
                <?php endif; ?>
            </a>
            <div class='ml-3'>
                <h3 class="text-base">
                    <?php 
                        echo htmlspecialchars($username);
                        $date = htmlspecialchars($post->getpostedTime());
                        // $timestamp = strtotime($date);
                        echo htmlspecialchars(Utils::timeAgo($date));
                    ?>
                </h3>
                <h2 class="m-0 text-3xl leading-1"><?= htmlspecialchars($postTitle) ?></h2>
            </div>
        </div>
        <?php if ($currentUserId == $ownerId || $currentUserIsAdmin) :?>
            <div class="flex gap-4 justify-end items-center mr-5 mb-[1rem]">
                <a class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-1 size-8 text-xs" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>"><img class=""src="/forum/public/assets/img/editWhite.svg" alt=""></a>
                <a class="bg-red-400 border-solid border-red-500 border-2 p-1 size-8 text-xs" href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt=""></a>
            </div>
        <?php endif; ?>
    </div>
    <hr class="min-w-[85%] place-self-center">

    <div class="post-content m-auto my-[1rem]">      
        <p class= "mx-[5rem] my-[1rem]"><?= htmlspecialchars($postContent)?></p>
        <?php if ($postImage) : ?>
            <img class="m-auto object-cover max-w-[1050px] max-h-[650px]" src="/forum/public/<?= htmlspecialchars($postImage) ?>" alt="Post Image">
        <?php endif; ?>
    </div>
</div>



<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php';
?>