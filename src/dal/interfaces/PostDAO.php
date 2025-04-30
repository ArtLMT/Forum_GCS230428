<?php
namespace src\dal\interfaces;

interface PostDAO {
    public function createPost($title, $content, $userId, $moduleId, $imagePath = null);
    public function updatePost($postId, $title, $content, $moduleId, $imagePath = null);
    public function getPostById($postId);
    public function getPostByTitle($title);
    public function getPostByUserId($userId);
    public function countPostByUser($userId);
    public function getPostsByModuleId($moduleId);
    public function getAllPosts();
    public function deletePost($postId);
    public function getTotalPost();
    public function getPostsPaginated($limit, $offset);
}
?>