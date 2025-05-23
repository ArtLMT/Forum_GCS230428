<?php
ob_start(); // Start output buffering
?>

<form class="bg-white border-solid border-2 rounded-lg" action="/forum/public/admin/createModule" method="post">
    <div class="m-4 flex flex-col items-center">
        <label>Module Name:</label>
        <input class="px-3 bg-gray-300 text-gray-700 mb-4 w-[80%] rounded-xl" type="text" name="module_name" required>
        
        <label>Module Description:</label>
        <textarea class="text-gray-700 bg-gray-300 mb-4 w-[80%] h-50 text-justify rounded-3xl px-3" name="module_description" required></textarea>
        
        <input class="flex justify-center bg-green-400 border-solid border-green-600 border-2 p-3 rounded-2xl transition duration-400 ease-in-out transform hover:scale-105" type="submit" value="Create Module">
    </div>
</form>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/adminLayout.html.php';
?>
