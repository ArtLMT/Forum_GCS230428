<?php
ob_start();
$title = "List of feedbacks";
?>

<h2 class="flex justify-center text-2xl">Feedback:</h2>
<a class="justify-center bg-green-400 border-solid border-green-700 border-2 p-1 w-14 text-xs" href="/forum/public/createMessagePage">Send Feedback</a>
<?php if(!empty($messages)) : ?>
    <div class="">
        <?php foreach($messages as $message) : ?>
            <div class="bg-white border-solid border-2 rounded-lg border-green-600 pt-5 px-5 mt-10">
                <div class="MessageHeader flex item-center">
                    
                    <div class="block">
                        <h1>
                            <?php
                                $userId = $message->getUserId();
                                $username = $userDAO->getUsername($userId);
                                echo htmlspecialchars($username);
                            ?>
                        </h1>
                        <h2><?=htmlspecialchars($message->getTitle())?></h2>
                    </div>
                </div>
                <div>
                    <?=htmlspecialchars($message->getContent())?>
                </div>
                <div class="flex gap-4 justify-end text-center mr-5 mb-4 mt-4">
                    <a class="bg-green-400 border-solid border-green-700 border-2 p-1 w-14 text-xs" href="/forum/public/editMessage?id=<?= htmlspecialchars($message->getEmailMessageId()) ?>">Edit</a>
                    <a class="bg-red-400 border-solid border-red-500 border-2 p-1 w-14 text-xs" href="/forum/public/deleteEmailMessage?id=<?= htmlspecialchars($message->getEmailMessageId()) ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<?php
$content = ob_get_clean();
include dirname(__DIR__) . '/layouts/layout.html.php';
?>