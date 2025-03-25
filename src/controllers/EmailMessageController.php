<?php
namespace src\controllers;

use src\dal\implementations\EmailMessageDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\dal\utils\Validation;

class EmailMessageController{
    private $emailDAO;
    private $userDAO;
    
    public function __construct() {
        $this->emailDAO = new EmailMessageDAOImpl();
        $this->userDAO = new UserDAOImpl();
    }

    public function createMessage($title, $content, $userId)
    {
        $this->emailDAO->sendMessage($title, $content, $userId);
    }

    // need to pass all message to the view
    public function listMessage()
    {
        $messages = $this->emailDAO->getAllMessage();
        foreach ($messages as $message) {
            $emailId = $message->getEmailMessageId();
        }

        require_once __DIR__ . '/../views/messages/messagesList.html.php';
    }
}
?>