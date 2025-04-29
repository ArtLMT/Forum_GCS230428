<?php
namespace src\controllers;

use src\dal\implementations\CommentDAOImpl;

use src\utils\Validation;
use src\utils\SessionManager;
use src\utils\Utils;

class CommentController {
    private $commentDAO;

    public function __construct()
    {
        $this->commentDAO = new commentDAOImpl();
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

        $postId = $_POST['post_id'];
        $content = $_POST['content'];
        $currentUser = SessionManager::get('user');
        $userId = $currentUser->getUserId();

        $this->commentDAO->createComment($content,$userId, $postId);
        header("location: /forum/public/postDetail?post_id=$postId");
        exit();
    }

    public function getComment($postId) 
    {
        $this->isLoggedIn();
        
        // $postId = $_GET('id');
        
        $comments = $this->commentDAO->getCommentsByPostId($postId);
        return $comments;
    }

    public function getCommentById($commentId) 
    {
        $this->isLoggedIn();
        
        // $postId = $_GET('id');
        
        $comment = $this->commentDAO->getCommentById($commentId);
        return $comment;
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $commentId = $_POST['comment_id'];
        $postId = $_POST['post_id'];
        $content = $_POST['content'];
        
        if (!$commentId || !$this->commentDAO->getCommentById($commentId)) {
            $message = "Oops! Invalid Comment ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }
        
        $comment = $this->commentDAO->getCommentById($commentId);
        $currentUser = SessionManager::get('user');
        $owner = $comment->getUserId();
        if ($owner !== $currentUser->getUserId()) {
            $message = "Oops! You're not authorized to do this.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $this->commentDAO->updateComment($commentId, $content);

        header("Location: /forum/public/postDetail?post_id=$postId");
        exit();
    }

    public function destroy()
    {
        $this->isLoggedIn();
        $commentId = $_GET['id'] ?? null;

        if (!$commentId || !$this->commentDAO->getCommentById($commentId)) {
            $message = "Oops! Invalid Comment ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $this->commentDAO->deleteComment($commentId);
        header("Location: /forum/public/postDetail?post_id=$postId");
        exit();
    }

}