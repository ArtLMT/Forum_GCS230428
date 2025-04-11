<?php
ob_start();
?>

<div class="h-[calc(100vh-8rem-100px)]">
    <?php if (!empty($users)) : ?>
        <!-- Header row -->
        <div class=" flex justify-center items-center grid grid-cols-5 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 80px 1fr 2fr 160px 1fr;" >
            <div class="flex justify-center items-center">User ID</div>
            <div>Username</div>
            <div>Email</div>
            <div>Actions</div>
            <div class="flex items-center justify-center">Promote</div>
        </div>

        <!-- Data rows -->
        <div class="h-[602px]">
            <?php foreach ($users as $user) : ?>
                <div class="flex justify-center items-center grid grid-cols-5 bg-gray-300 text-black text-base py-2 px-4 my-[4px] rounded-full hover:bg-gray-100 duration-700 ease-in-out transform hover:scale-105"
                style="grid-template-columns: 80px 1fr 2fr 160px 1fr;">
                    <div class="flex justify-center items-center"><?= htmlspecialchars($user->getUserId()) ?></div>
                    <div><?= htmlspecialchars($user->getUsername()) ?></div>
                    <div><?= htmlspecialchars($user->getEmail()) ?></div>
                    <div class="flex gap-2">
                        <a class="flex justify-center bg-sky-400 hover:bg-cyan-400 px-2 py-1 size-12 rounded" href="/forum/public/admin/editUser?user_id=<?= $user->getUserId() ?>"><img class="text-red-500"src="/forum/public/assets/img/edit_white.svg" alt=""></a>
                        <form action="/forum/public/deleteUser" method="POST" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="user_id" value="<?= $user->getUserId() ?>">
                            <button class=" flex justify-center bg-gray-400 hover:bg-red-400 px-2 py-1 rounded size-12" type="submit"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt=""></button>
                        </form>
                    </div>
                    <div class="flex justify-center items-center">
                        <?php if($user->getIsAdmin()) : ?>
                            <a class="flex items-center justify-center bg-red-400 hover:bg-red-500 text-white font-semibold w-[120px] h-8 rounded-full text-center" href="">Demote</a>
                        <?php else : ?>
                            <a class="flex items-center justify-center bg-emerald-400 hover:bg-emerald-500 text-white font-semibold w-[120px] h-8 rounded-full text-center" href="">Promote</a>
                        <?php endif;?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
         <!-- pagination section -->
        <div class="text-center mt-6">
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