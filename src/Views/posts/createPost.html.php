<?php
ob_start(); // Start output buffering
$title = "Create Post";
?>

<h2 class="text-center ">Create Post</h2>

<form class="bg-white border-solid border-2 rounded-lg text-slate-800" action="/forum/public/createPost" method="post" enctype="multipart/form-data">  
    <div class="m-4 flex flex-col items-center">    
        <label>Title:</label>
        <input class="px-3 bg-gray-300 text-gray-700 mb-4 w-[80%] rounded-xl" type="text" name="title" required>
        
        <select class="px-3 bg-gray-300 text-gray-700 mb-4 w-[80%] rounded-xl"name="module_id" required>
        <option class="px-3 bg-gray-300 text-gray-700 mb-4 w-[80%] rounded-xl" value="">Select a Module</option>
            <?php foreach ($modules as $module): ?>
                <option class="px-3 bg-gray-300 text-gray-700 mb-4 w-[80%] rounded-xl" value="<?= $module->getModuleId() ?>"><?= htmlspecialchars($module->getModuleName()) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label>Content:</label>
        <textarea class="px-3 bg-gray-300 text-gray-700 mb-4 w-[80%] h-80 rounded-xl" name="content" required></textarea>
        
        
        <label>Image:</label>
        <input type="file" name="image">
        
        <input class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-3 rounded-2xl transition duration-400 ease-in-out transform hover:scale-105" type="submit" value="Create Post">
    </div>
</form>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php';
?>
