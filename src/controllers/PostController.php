<?php
require_once __DIR__ . "/../dao/implementations/PostDAOImpl.php";

class PostController {
    private $postDAO;

    public function __construct() {
        $this->postDAO = new PostDAOImpl();
    }

    public function createPost($userId, $moduleId, $title, $content) {
        return $this->postDAO->createPost($userId, $moduleId, $title, $content);
    }

    public function getPostById($postId) {
        return $this->postDAO->getPostById($postId);
    }

    public function getAllPosts() {
        return $this->postDAO->getAllPosts();
    }

    public function updatePost($postId, $title, $content) {
        return $this->postDAO->updatePost($postId, $title, $content);
    }

    public function deletePost($postId) {
        return $this->postDAO->deletePost($postId);
    }
}
?>
