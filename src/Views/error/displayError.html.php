<?php
ob_start(); // start keeping what we write in memory

$title = "Error"; // page title
?>
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center space-y-6">
    <h1 class="text-4xl text-red-500 font-bold">⚠️ Error</h1>
    <p class="text-lg text-slate-600"><?= htmlspecialchars($message) ?></p>

    <a href="/forum/public/" class="mt-6 inline-block px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition">
        Go Home
    </a>
</div>
<?php
$content = ob_get_clean(); // grab the memory into $content
include dirname(__DIR__) . '/layouts/layout.html.php'; // use your big layout
?>
