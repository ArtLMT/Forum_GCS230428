<?php
namespace src\dal\interfaces;

interface EmailMessageDAO {
    public function sendMessage($title, $content, $userId);
    public function getAllMessage();
    public function deleteEmail($emailId); // for admin only
    public function getMessageById($emailId);
    public function getMessage($data);
}
?>