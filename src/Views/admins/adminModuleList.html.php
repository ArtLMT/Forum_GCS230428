<?php
ob_start();
?>

<div class="h-[calc(100vh-8rem-100px)]">
    <div>

    </div>
    <?php if (!empty($modules)) : ?>
        <div class=" flex justify-center items-center grid grid-cols-4 font-bold text-white bg-gray-800 py-2 px-4"
            style="grid-template-columns: 80px 1fr 2fr 80px;" >
            <div class="flex justify-center items-center">Module ID</div>
            <div>Name</div>
            <div>Description</div>
            <div>Posts</div>    
        </div>

        <div class="h-[602px]">
            <?php foreach ($modules as $module) : ?>
                <div class="flex justify-center items-center grid grid-cols-4 bg-gray-300 text-black text-base py-2 px-4 my-[4px] rounded-full hover:bg-gray-100 duration-700 ease-in-out transform hover:scale-105"
                style="grid-template-columns: 80px 1fr 2fr 80px;">
                    <div><?= htmlspecialchars($module->getModuleId())?></div>
                    <div><?= htmlspecialchars($module->getModuleName())?></div>
                    <div><?= htmlspecialchars($module->getModuleDescription())?></div>
                    <td><?= $postCounts[$module->getModuleId()]?> Posts</td>
                </div>
            <?php endforeach;?>
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
        <p class="text-white px-4 py-2">No Modules available.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>