<?php 
ob_start(); // Start output buffering
?>
<h1 class="text-center text-3xl">This is profile page / Update page</h1>
<?php if (isset($user) && $user !== null) : ?>

<?php else: ?>
    <p>Error: User not found.</p>
<?php endif; ?>

<?php
$content = ob_get_clean(); // Store the buffered output into $content
include __DIR__ . '/../layouts/layout.html.php'; // Include the layout
?>