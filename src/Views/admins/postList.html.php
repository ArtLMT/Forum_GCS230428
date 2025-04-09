<?php
ob_start();
?>

<div>
    Posts
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/adminLayout.html.php';
?>