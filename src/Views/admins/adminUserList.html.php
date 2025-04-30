<?php
ob_start();
?>

<div class="h-[calc(100vh-8rem-100px)]">
    <?php if (!empty($users)) : ?>
        <!-- Header row -->
        <div class=" flex justify-center items-center grid grid-cols-6 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 80px 80px 1fr 2fr 160px 1fr;" >
            <div class="flex justify-center items-center">User ID</div>
            <div>Avatar</div>
            <div class="ml-5">Username</div>
            <div>Email</div>
            <div class="flex justify-center items-center">Actions</div>
            <div class="flex items-center justify-center">Role</div>
        </div>

        <!-- Data rows -->
        <div class="h-[560px]">
            <?php foreach ($users as $user) : ?>
                <div class="flex justify-center items-center grid grid-cols-6 bg-gray-300 text-black text-base py-2 px-4 my-[4px] rounded-full hover:bg-gray-100 duration-700 ease-in-out transform hover:scale-105"
                style="grid-template-columns: 80px 80px 1fr 2fr 160px 1fr;">
                    <p class="flex justify-center items-center"><?= htmlspecialchars($user->getUserId()) ?></p>
                    <div class="flex justify-center items-center">
                         <?php
                            $userImage = $user->getUserImage();
                            $username = $user->getUsername();
                        ?>
                        <div class="size-12 flex items-center justify-center bg-indigo-500 text-white rounded-full text-xl font-bold">
                            <?php if ($userImage) : ?>
                                    <img src="/forum/public/<?= htmlspecialchars($userImage) ?>" class="size-12 rounded-full object-cover" alt="User Profile">
                                <?php else : ?>
                                    <?= strtoupper(substr($username, 0, 1)) // Get first letter and make it uppercase  ?> 
                                <?php endif; ?>
                        </div>
                    </div>
                    <p class="ml-5">
                        <?= htmlspecialchars($user->getUsername()) ?>
                    </p>
                    <p><?= htmlspecialchars($user->getEmail()) ?></p>
                    <div class="flex justify-center items-center">
                        <a href="/forum/public/admin/editUser?user_id=<?= htmlspecialchars($user->getUserId()) ?>" class=" flex justify-center bg-blue-400 hover:bg-blue-500 px-2 py-1 rounded size-12"><img src="/forum/public/assets/img/edit_white.svg" alt="edit"></a>
                        <form action="/forum/public/admin/deleteUser" method="POST" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()) ?>">
                            <button class=" flex justify-center bg-gray-400 hover:bg-red-400 px-2 py-1 rounded size-12" type="submit"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt="deletebtn"></button>
                        </form>
                    </div>
                    <div class="flex justify-center items-center">
                        <form method="POST" action="/forum/public/admin/updateUserRole" class="inline">
                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user->getUserId()); ?>">
                            <input type="hidden" name="is_admin" value="<?= $user->getIsAdmin(); ?>">
                            
                            <?php if ($user->getIsAdmin()) : ?>
                                <button type="submit" class="flex items-center justify-center bg-red-400 hover:bg-red-500 text-white font-semibold w-[120px] h-8 rounded-full text-center">
                                    Admin
                                </button>
                            <?php else : ?>
                                <button type="submit" class="flex items-center justify-center bg-emerald-400 hover:bg-emerald-500 text-white font-semibold w-[120px] h-8 rounded-full text-center">
                                    Student
                                </button>
                            <?php endif; ?>
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