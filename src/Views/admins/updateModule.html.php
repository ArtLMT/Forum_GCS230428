<?php
ob_start();
?>
<?php if (isset($module) && $module !== null): ?>
    <h2>Update Module</h2>
    <form action="/forum/public/admin/updateModule" method="post">
        <input type="hidden" name="module_id" value="<?= htmlspecialchars($module->getModuleId()) ?>">

        <label>Module Name:</label>
        <input type="text" name="module_name" value="<?= htmlspecialchars($module->getModuleName()) ?>" required><br>

        <label>Module Description:</label>
        <textarea name="module_description" required><?= htmlspecialchars($module->getModuleDescription()) ?></textarea><br>

        <input type="submit" value="Update Module">
    </form>
<?php else: ?>
    <p>Error: Module not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>
