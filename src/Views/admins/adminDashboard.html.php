<?php
ob_start();
?>

<div class="bg-gray-600 h-[calc(100vh-8rem-100px)]">
Worked
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>