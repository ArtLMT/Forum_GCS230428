<?php
ob_start();
?>

<?php if (isset($module) && $module !== null): ?>
    <div class="max-w-xl mx-auto mt-6 p-6 bg-white rounded-2xl shadow-md space-y-6 bg-gray-50">
        <h2 class="text-2xl font-bold text-center text-gray-800">Edit Module Details</h2>
        <form action="/forum/public/updateModule" method="post" class="space-y-5">
            <input type="hidden" name="module_id" value="<?= htmlspecialchars($module->getModuleId()) ?>">

            <!-- Module Name -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Module Name</label>
                <input type="text" name="module_name"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 <?= isset($errors['module_name']) ? 'focus:ring-red-500 border-red-500' : 'focus:ring-blue-400 border-gray-300' ?>"
                    value="<?= htmlspecialchars($module->getModuleName()) ?>" required>
                <?php if (!empty($errors['module_name'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['module_name']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Module Description -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Module Description</label>
                <textarea name="module_description" rows="5"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 <?= isset($errors['module_description']) ? 'focus:ring-red-500 border-red-500' : 'focus:ring-blue-400 border-gray-300' ?>"
                    required><?= htmlspecialchars($module->getModuleDescription()) ?></textarea>
                <?php if (!empty($errors['module_description'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= htmlspecialchars($errors['module_description']) ?></p>
                <?php endif; ?>
            </div>

            <!-- Submit -->
            <div class="text-center">
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                    Update Module
                </button>
            </div>
        </form>
    </div>
<?php else: ?>
    <p class="text-center text-red-500 font-semibold mt-6">Error: Module not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>
