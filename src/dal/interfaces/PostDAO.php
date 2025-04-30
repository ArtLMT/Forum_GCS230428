<?php
namespace src\dal\interfaces;

interface PostDAO {
    public function createPost($title, $content, $userId, $moduleId, $imagePath = null);
    public function updatePost($postId, $title, $content, $moduleId, $imagePath = null);
    public function getPostById($postId): ?Post;
    public function getPostByTitle($title): ?Post;
    public function getPostByUserId($userId);
    public function countPostByUser($userId): int;
    public function getPostsByModuleId($moduleId);
    public function getAllPosts(): array;
    public function deletePost($postId);
    public function getTotalPost();
    public function getPostsPaginated($limit, $offset): array;
}
?>