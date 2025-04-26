<?php
ob_start();
use src\controllers\UserController;
use src\controllers\PostController;
use src\utils\Utils;

$title = $postTitle;
?>
<!-- <?php var_dump($userId)?> -->

<div class="post bg-white border-solid border-2 border-indigo-500 shadow-md rounded-lg my-8">
    <!-- <div><img src="/forum/public/assets/img/backButton.svg" alt=""></div> -->
    <div class="post-header flex p-3 items-center">
        <a class="relative left-2"href="/forum/public/"><img src="/forum/public/assets/img/back_button_black.svg" alt="" class="size-12"></a>
        <div class="flex items-center justify-start ml-6 w-full">
            <a class="size-14 flex items-center justify-center bg-indigo-500 text-white rounded-full text-4xl font-bold" href="/forum/public/showProfile?id=<?=$post->getUserId()?>">
                <?php if ($userImage) : ?>
                    <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-14 rounded-full object-cover" alt="User Profile">
                <?php else : ?>
                    <?= $firstLetter ?>
                <?php endif; ?>
            </a>
            <div class='ml-3'>
                <h3 class="text-slate-500 text-sm">
                    <?= htmlspecialchars($username); ?>  • <?= htmlspecialchars(Utils::timeAgo($post->getPostedTime())); ?>
                </h3>
                <h2 class="m-0 text-3xl text-indigo-700 font-bold"><?= htmlspecialchars($postTitle) ?></h2>
            </div>
        </div>
        <?php if ($currentUserId == $ownerId) :?>
            <div class="flex gap-4 justify-end items-center mr-5 mb-4 text-white font-semibold">
                <a class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-1 w-14 h-8 text-xs" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>"><img class=""src="/forum/public/assets/img/edit_white.svg" alt="">Edit</a>
                <a class="flex justify-center bg-red-400 border-solid border-red-500 border-2 p-1 w-14 h-8 text-xs" href="/forum/public/delete?id=<?= htmlspecialchars($post->getPostId()) ?>" onclick="return confirm('Are you sure?');"><img class="size-4" src="/forum/public/assets/img/deleteWhite.svg" alt="">Delete</a>
            </div>
        <?php endif; ?>
    </div>
    <hr class="min-w-[85%] place-self-center">

    <div class="post-content m-auto my-4">      
        <p class= "mx-20 my-4 text-slate-700"><?= htmlspecialchars($postContent)?></p>
        <?php if ($postImage) : ?>
            <img class="m-auto object-cover max-w-[900px] max-h-[600px] rounded-md shadow-sm" src="/forum/public/<?= htmlspecialchars($postImage) ?>" alt="Post Image">
        <?php endif; ?>
    </div>

    <!-- Comment -->
    <div class="px-12 py-6 bg-gray-50 border-t border-indigo-200">
        <form action="/forum/public/addComment" method="post" class="flex flex-col gap-4 max-w-3xl mx-auto">
            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getPostId()) ?>">

            <textarea 
                name="content" 
                placeholder="Write your comment..." 
                required 
                class="border-2 border-indigo-400 rounded-md p-3 h-28 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-300"
            ></textarea>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-indigo-600 text-white font-medium px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                    Post Comment
                </button>
            </div>
        </form>
    </div>
    <div class="px-12 py-6 bg-white">
    <h3 class="text-2xl font-semibold text-indigo-700 mb-6">Comments</h3>

    <?php foreach ($comments as $comment) : ?>
        <div class="flex gap-4 mb-6 p-4 bg-indigo-50 border border-indigo-200 rounded-md shadow-sm max-w-4xl">
            <a href="/forum/public/showProfile?id=<?= $comment->getUserId() ?>" class="shrink-0">
                <?php if ($comment->getUserImage()) : ?>
                    <img src="/forum/public/<?= htmlspecialchars($comment->getUserImage()) ?>" class="w-14 h-14 rounded-full object-cover" alt="User Profile">
                <?php else : ?>
                    <div class="w-14 h-14 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xl font-bold">
                        <?= $firstLetter ?>
                    </div>
                <?php endif; ?>
            </a>

            <div>
                <p class="text-sm text-gray-500 font-medium mb-1"><?= $comment->getUsername() ?></p>
                <p class="text-gray-700"><?= htmlspecialchars($comment->getContent()) ?></p>
            </div>
        </div>
    <?php endforeach ?>
</div>
</div>



<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php';
?>