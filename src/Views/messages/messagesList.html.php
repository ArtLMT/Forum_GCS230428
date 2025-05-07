<?php
ob_start();
$title = "List of feedbacks";
?>

<h2 class="text-center text-2xl">Feedback:</h2>
<!-- <a class="justify-center bg-green-400 border-solid border-green-700 border-2 p-1 w-14 text-xs" href="/forum/public/createMessagePage">Send Feedback</a> -->
<?php if(!empty($messages)) : ?>
    <div class="mt-4">
        <?php foreach($messages as $message) : ?>
            <div class="bg-white border-solid border-2 rounded-lg border-indigo-200 pt-5 px-5 my-5">
                <div class="MessageHeader flex item-center">
                    <div class="block w-full">
                        <h1 class="text-center m-0 text-3xl text-indigo-700 font-bold"><?=htmlspecialchars($message->getTitle())?></h1>
                        <h3 class="text-center text-sm"> by
                            <?php
                                $userId = $message->getUserId();
                                $username = $userDAO->getUsername($userId);
                                echo htmlspecialchars($username);
                            ?>
                        </h3>
                    </div>
                </div>
                <div class="mt-2 mb-4">
                    <?=htmlspecialchars($message->getContent())?>
                </div>
                <?php 
                    $isOwner = $authController->isOwner($userId);
                ?>

            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php';
?>