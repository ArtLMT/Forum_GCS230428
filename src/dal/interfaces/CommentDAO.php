<?php
namespace src\dal\interfaces;

class CommentDAO {
    public function createComment($content, $userId, $postId);
    public function getCommentById($commentId);
    public function getCommentsByPostId($postId);
    public function updateComment($commentId, $content);
    public function deleteComment($commentId);
}
?>