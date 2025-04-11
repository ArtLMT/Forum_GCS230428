<?php
ob_start(); // Start output buffering
$title = "List of Modules";
?>

<?php if(!empty($modules)) : ?>
    <div class="grid grid-cols-3 gap-4">
        <?php foreach($modules as $module) : ?>
            <a class="bg-white p-4 rounded shadow" href="/forum/public/postByModule?id=<?= htmlspecialchars($module->getModuleId())?>">
                <h2 class="text-xl font-bold text-center"><?= htmlspecialchars($module->getModuleName()) ?></h2>
                <p><?= htmlspecialchars($module->getModuleDescription()) ?></p>
            </a>
            <!-- <hr class="mt-2 mb-2">
            <div class="module">
                <div class="module-header">
                    <h2><?= htmlspecialchars($module->getModuleName()) ?></h2>
                </div>
                <div class="module-content">
                    <p><?= htmlspecialchars($module->getModuleDescription()) ?></p>
                </div>
                <div class="module-footer">
                    <a href="/forum/public/updateModule?id=<?= htmlspecialchars($module->getModuleId()) ?>">Edit</a>
                    <a href="/forum/public/deleteModule?id=<?= htmlspecialchars($module->getModuleId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div> -->
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No modules available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>