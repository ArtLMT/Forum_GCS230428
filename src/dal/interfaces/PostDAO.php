<?php
namespace src\dal\interfaces;

interface PostDAO {
    public function createPost($title, $content, $userId, $moduleId);
    public function updatePost($postId, $title, $content, $moduleId);
    public function getPostById($postId);
    public function getPostByTitle($title);
    public function getPostByUserId($userId);
    public function deletePost($postId);
    public function getAllPosts();
}
?>