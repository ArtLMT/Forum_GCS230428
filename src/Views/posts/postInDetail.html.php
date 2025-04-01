<?php
ob_start();
use src\controllers\UserController;
use src\dal\implementations\UserDAOImpl;
use src\controllers\PostController;
?>

<h1>POST IN DETAILS</h1>
<p>Update Later</p>
<!-- <?php var_dump($postId)?> -->
<?php 
    $userDAO = new UserDAOImpl(); // Create an instance of UserDAOImpl
    // remove these???
    $user = $userDAO->getUserById($post->getUserId());
    $userImage = $user->getUserImage();
    $username = $userDAO->getUsername($post->getUserId());
    $firstLetter = strtoupper(substr($username, 0, 1)); // Get first letter and make it uppercase
?>
<div class="post w-2/3 mx-auto bg-slate-900 border-solid border-2 rounded-lg border-gray-600">
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
        <p class= "mx-[5rem] my-[1rem]"><?= htmlspecialchars($post->getContent())?></p>
        <?php if ($post->getPostImage()) : ?>
            <img class="m-auto object-cover max-w-[900px] max-h-[600px]" src="/forum/public/<?= htmlspecialchars($post->getPostImage()) ?>" alt="Post Image">
        <?php endif; ?>
    </div>
</div>



<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/layout.html.php';
?>