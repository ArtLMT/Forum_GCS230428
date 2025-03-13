<?php
namespace src\dal\implementations;

use src\dal\interfaces\CommentDAO;
use src\config\Database;
use src\models\Comment;

class CommentDAOImpl {
    private $pdo;
    private $comment;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function createComment($content, $userId, $postId) {

    }

    public function updateComment($commentId, $content) {

    }

    public function getCommentById($commentId) {

    }

    public function getCommentsByPostId($postId) {

    }

    public function deleteComment($commentId) {

    }

    public function getAllComments() {

    }
}