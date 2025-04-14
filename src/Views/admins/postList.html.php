<?php
ob_start();
?>

<div class="h-[calc(100vh-8rem-100px)]">
    <?php if (!empty($posts)) : ?>
        <!-- Header row -->
        <div class=" flex justify-center items-center grid grid-cols-5 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 80px 0.25fr 0.5fr 1fr 0.5fr;" >
            <div class="flex justify-center items-center">Post ID</div>
            <div class="flex justify-center items-center">Author</div>
            <div>title</div>
            <div>content</div>
            <div class="flex justify-end">Actions</div>
            <!-- <div>Actions</div> -->
            <!-- <div class="flex items-center justify-center">Promote</div> -->
        </div>

        <!-- Data rows -->
        <div class="h-[560px]">
            <?php foreach ($posts as $post) : ?>
                <div class="flex justify-center items-center grid grid-cols-5 bg-gray-300 text-black text-base py-2 px-4 my-[4px] rounded-full hover:bg-gray-100 duration-700 ease-in-out transform hover:scale-105"
                style="grid-template-columns: 80px 0.25fr 0.5fr 1fr 0.5fr;">
                    <div class="flex justify-center items-center"><?= htmlspecialchars($post->getPostId()) ?></div>
                    <div class="flex flex-row">
                        <a class="flex flex-row items-center"href="/forum/public/showProfile?id=<?=$post->getUserId()?>">
                            <div class="size-12 flex items-center justify-center bg-indigo-500 text-white rounded-full text-xl font-bold mr-4">
                                <?php if ($post->getUserImage()) : ?>
                                    <img src="/forum/public/<?= htmlspecialchars($post->getUserImage()) ?>" class="size-12 rounded-full object-cover" alt="User Profile">
                                <?php else : ?>
                                    <?= strtoupper(substr($post->getUsername(), 0, 1)) // Get first letter and make it uppercase  ?> 
                                <?php endif; ?>
                            </div>
                            <p><?= htmlspecialchars($post->getUsername())?></p>
                        </a>
                    </div>
                    <div class="truncate w-40"><?= htmlspecialchars($post->getTitle()) ?></div>
                    <div class="truncate w-80"><?= htmlspecialchars($post->getContent()) ?></div>
                    <div class="flex gap-4 justify-end items-center mr-5 mb-[1rem]">
                        <a class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-1 size-8 text-xs" href="/forum/public/update?id=<?= htmlspecialchars($post->getPostId()) ?>"><img class=""src="/forum/public/assets/img/editWhite.svg" alt=""></a>
                        <form action="/forum/public/admin/deletePost" method="POST" onsubmit="return confirm('Are you sure?');" class="bg-red-400 border-solid border-red-500 border-2 p-1 size-8 text-xs">
                            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post->getPostId()) ?>">
                            <button class="" type="submit"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt=""></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
         <!-- pagination section -->
        <div class="text-center">
            <?php if ($totalPages > 1): ?>
                <div class="inline-flex gap-2">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <!-- When clicked, this refreshes the page and passes ?page=NUMBER to the URL -->
                    <!-- Then showDashboard() will run again and load the new page's users -->
                        <a class="px-3 py-1 rounded <?= $i == $page ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' ?>" href="?page=<?= $i ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </div>

    <?php else : ?>
        <p class="text-white px-4 py-2">No users available.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>