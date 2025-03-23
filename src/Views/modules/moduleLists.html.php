<?php
ob_start(); // Start output buffering
?>

<?php if(!empty($modules)) : ?>
    <div>
        <?php foreach($modules as $module) : ?>
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
            </div>
            <br>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No modules available.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>