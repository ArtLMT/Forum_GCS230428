<?php
ob_start();
?>

<h2>Feedback:</h2>
<?php if(!empty($messages)) : ?>
    <div>
        <?php foreach($messages as $message) : ?>
            <div>
                <?php 
                    $userId = $message->getUserId();
                    $username = $userDAO->getUsername($userId);
                ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php';
?>