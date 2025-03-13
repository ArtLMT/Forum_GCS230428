<?php
namespace src\dal\interfaces;

class CommentDAO {
    public function createComment($content, $userId, $postId);
    public function updateComment($commentId, $content);
    public function getCommentById($commentId);
    public function deleteComment($commentId);
    public function getAllComments();
}
?>