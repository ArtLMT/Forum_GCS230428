<?php
namespace src\dal\interfaces;

interface EmailMessageDAO {
    public function sendMessage($title, $content, $userId);
    public function deleteMessage($messageId); // for admin only
    public function getAllMessage();
}
?>