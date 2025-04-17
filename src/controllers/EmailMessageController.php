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

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }
        $title = $_POST['title'];
        $content = $_POST['content'];
        
        $currentUser = SessionManager::get('user');
        $userId = $currentUser->getUserId();
        
        $this->emailDAO->sendMessage($title, $content, $userId);
        header("Location: /forum/public/messageList");
        exit();
    }

    public function createMessage()
    {
        require_once __DIR__ . '/../views/messages/sendMessage.html.php';
    }

    // need to pass all message to the view
    public function listMessage()
    {
        $messages = $this->emailDAO->getAllMessage();
        $userDAO = $this->userDAO;
        foreach ($messages as $message) {
            $emailId = $message->getEmailMessageId();
        }

        require_once __DIR__ . '/../views/messages/messagesList.html.php';
    }

    public function edit() 
    {
        $emailId = $_GET['id'] ?? null;

        if (!$emailId) {
            echo "Message ID not provided";
        }

        $message = $this->emailDAO->getMessageById($emailId);
        // echo "<pre>";
        // print_r($message);
        // echo "</pre>";
        // exit();

        require_once __DIR__ . '/../views/messages/editMessages.html.php';
    }

    public function update()
    {
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }
            // Debugging: Print the received POST data

        $emailId = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $this->emailDAO->updateMessage($emailId, $title, $content);
        header("Location: /forum/public/messageList/");
        exit();
    }

    public function destroy() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $emailId = $_GET['id'] ?? null;
        $this->emailDAO->deleteEmail($emailId);

        header("Location:/forum/public/messageList/");
        exit();
    }
}
?>