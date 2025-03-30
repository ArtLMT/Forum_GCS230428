<?php
ob_start();
?>
<div>
<?php
echo 'User\'s Posts: '
?>
</div>

<?php
$userPost = ob_get_clean();
include dirname(__DIR__) . '/../users/profile.html.php';
?>