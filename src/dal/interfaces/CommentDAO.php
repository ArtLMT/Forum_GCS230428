<?php
namespace src\dal\interfaces;

class CommentDAO {
    public function createComment($content, $userId, $postId);
    public function getCommentById($commentId): ?Comment;
    public function getCommentsByPostId($postId): array;
    public function updateComment($commentId, $content);
    public function deleteComment($commentId);
}
?>