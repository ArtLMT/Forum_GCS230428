<?php
namespace src\dao\interfaces;

class CommentDAO {
    public function createComment($content, $userId, $postId);
    public function updateComment($commentId, $content);
    public function getCommentById($commentId);
    public function deleteComment($commentId);
    public function getAllComments();
}
?>