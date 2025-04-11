<?php
ob_start(); // Start output buffering
$title = "List of Modules";
?>

<h2 class="text-xl font-bold mb-4">List of modules: </h2>

<?php if(!empty($modules)) : ?>
    <div class="grid grid-cols-2 gap-14">
        <?php foreach($modules as $module) : ?>
            <a class="bg-white rounded shadow-lg transition-transform hover:scale-105 hover:shadow-xl" href="/forum/public/postByModule?id=<?= htmlspecialchars($module->getModuleId())?>">
                <h2 class="text-xl font-bold text-center py-2"><?= htmlspecialchars($module->getModuleName()) ?></h2>
                <p class="bg-gray-300 text-center py-2"><?= htmlspecialchars($module->getModuleDescription()) ?></p>
                <div class="flex items-center justify-center py-2">
                    <p class="text-center py-1 text-sm text-gray-600">
                        Total Posts: <?= $modulePostCounts[$module->getModuleId()]?>
                    </p>
                    
                    <?php
                        $count = $modulePostCounts[$module->getModuleId()] ?? 0;
                        $badge = $count > 7 ? 'High' : ($count > 3 ? 'Medium' : 'Low');
                        $badgeColor = $count > 7 ? 'green' : ($count > 3 ? 'yellow' : 'red');
                    ?>
                    <span class="text-xs px-2 py-1 rounded-full bg-<?= $badgeColor ?>-200 text-<?= $badgeColor ?>-800">
                        <?= $badge ?> activity
                    </span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No modules available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>