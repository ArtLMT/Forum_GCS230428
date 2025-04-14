<?php
ob_start();
?>

<div class="h-[calc(100vh-8rem-100px)]">
    <?php if (!empty($modules)) : ?>
        <div class=" flex justify-center items-center grid grid-cols-5 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 90px 1fr 2fr 80px 160px;" >
            <div class="flex justify-center items-center">Module ID</div>
            <div class="ml-4">Name</div>
            <div>Description</div>
            <div>Posts</div>
            <div class="flex justify-center items-center">Action</div>
        </div>

        <div class="h-[560px]">
            <?php foreach ($modules as $module) : ?>
                <div class="flex justify-center items-center grid grid-cols-5 bg-gray-300 text-black text-base py-2 px-4 my-[4px] rounded-full hover:bg-gray-100 duration-700 ease-in-out transform hover:scale-105"
                style="grid-template-columns: 90px 1fr 2fr 80px 160px;">
                    <div class="flex justify-center items-center"><?= htmlspecialchars($module->getModuleId())?></div>
                    <div class="ml-4"><?= htmlspecialchars($module->getModuleName())?></div>
                    <div><?= htmlspecialchars($module->getModuleDescription())?></div>
                    <div><?= $postCounts[$module->getModuleId()]?> Posts</div>
                    <div class="flex justify-center items-center">
                       <a class="flex justify-center bg-sky-400 hover:bg-cyan-400 px-2 py-1 size-12 rounded" href="/forum/public/admin/editModule?id=<?= htmlspecialchars($module->getModuleId()) ?>"><img class="text-red-500"src="/forum/public/assets/img/edit_white.svg" alt=""></a>
                        <form action="/forum/public/admin/deleteModule" method="POST" onsubmit="return confirm('Are you sure?');">
                                <input type="hidden" name="module_id" value="<?= htmlspecialchars($module->getModuleId())?>">
                                <button class=" flex justify-center bg-gray-400 hover:bg-red-400 px-2 py-1 rounded size-12" type="submit"><img class="" src="/forum/public/assets/img/deleteWhite.svg" alt=""></button>
                        </form>
                    </div>
                </div>
            <?php endforeach;?>
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
        <p class="text-white px-4 py-2">No Modules available.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>