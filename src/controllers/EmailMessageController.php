<?php
namespace src\controllers;

use src\dal\implementations\EmailMessageDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\utils\SessionManager;
use src\utils\Validation;

class EmailMessageController{
    private $emailDAO;
    private $userDAO;
    
    public function __construct() {
        $this->emailDAO = new EmailMessageDAOImpl();
        $this->userDAO = new UserDAOImpl();
    }

    public function isLoggedIn()
    {
        $currentUser = SessionManager::get('user');
        if ($currentUser === null) {
            $errors['unauth'] = 'You need to login to access this page.';
            SessionManager::set('errors', $errors);
            header("Location: /forum/public/login");
            exit();
        }
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

        if (!Validation::validateNotEmpty($title) || !Validation::validateNotEmpty($content)) {
            $message = "Oops! Title and Content cannot be empty.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }
        
        $currentUser = SessionManager::get('user');
        $userId = $currentUser->getUserId();
        
        $this->emailDAO->sendMessage($title, $content, $userId);
        header("Location: /forum/public/messageList");
        exit();
    }

    public function createMessage()
    {
        $this->isLoggedIn();
        require_once __DIR__ . '/../views/messages/sendMessage.html.php';
    }

    // need to pass all message to the view
    public function listMessage()
    {
        $this->isLoggedIn();

        $messages = $this->emailDAO->getAllMessage();
        $userDAO = $this->userDAO;

        $authController = new AuthController();
        // $isOwner = $authController->isOwner($userId);

        foreach ($messages as $message) {
            $emailId = $message->getEmailMessageId();
        }

        require_once __DIR__ . '/../views/messages/messagesList.html.php';
    }

    public function edit() 
    {
        $this->isLoggedIn();
        $emailId = $_GET['id'] ?? null;

        if (!Validation::validateNotEmpty($emailId) || !Validation::checkEmailMessageById($emailId)) {
            $message = "Oops! Invalid email message ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        
        $message = $this->emailDAO->getMessageById($emailId);
        $currentUser = SessionManager::get('user');
        $currentUserId = $currentUser->getUserId();

        if ($message->getUserId() !== $currentUserId)
        {
            $message = "Oops! You're not authorized to edit this message.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

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

        if (!Validation::validateNotEmpty($emailId) || !Validation::checkEmailMessageById($emailId)) {
            $message = "Oops! Invalid email message ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        if (!Validation::validateNotEmpty($title) || !Validation::validateNotEmpty($content)) {
            $message = "Oops! Title and Content cannot be empty.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

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
        if (!Validation::validateNotEmpty($emailId) || !Validation::checkEmailMessageById($emailId)) {
            $message = "Oops! Invalid email message ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $this->emailDAO->deleteEmail($emailId);

        header("Location:/forum/public/messageList/");
        exit();
    }
}
?>