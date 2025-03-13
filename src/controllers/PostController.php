<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\ModuleDAOImpl;
use src\dal\implementations\UserDAOImpl;

class PostController {
    private $postDAO;
    private $moduleDAO;
    private $userDAO;

    public function __construct() 
    {
        $this->postDAO = new PostDAOImpl();
        $this->moduleDAO = new ModuleDAOImpl();
        $this->userDAO = new UserDAOImpl();
    }

    // Method to create a post
    public function createPost($title, $content, $userId, $moduleId) {
        $this->postDAO->createPost($title, $content, $userId, $moduleId);
    }

    // Method to update a post
    public function updatePost($postId, $title, $content, $moduleId) {
        $this->postDAO->updatePost($postId, $title, $content, $moduleId);
    }

    // Method to get a post by ID
    public function getPostById($postId) {
        return $this->postDAO->getPostById($postId);
    }

    // Method to get a post by title
    public function getPostByTitle($title) {
        return $this->postDAO->getPostByTitle($title);
    }

    // Method to delete a post
    public function deletePost($postId) {
        $this->postDAO->deletePost($postId);
    }

    // Method to get all posts
    public function getAllPosts() {
        return $this->postDAO->getAllPosts();
        require_once __DIR__ . '/../views/postList.html.php';
    }
}
?>
