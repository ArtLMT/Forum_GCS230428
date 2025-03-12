<?php
namespace src\dao\implementations;

// require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../../../config/Database.php";
require_once __DIR__ . "/../interfaces/PostDAO.php";
require_once __DIR__ . "/../../models/Post.php";

class PostDAOImpl implements PostDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function createPost($title, $content, $userId, $moduleId) 
    {

    }

    public function updatePost($postId, $title, $content, $moduleId) 
    {

    }

    public function getPostById($postId) 
    {

    }

    public function getPostByTitle($title) 
    {

    }

    public function deletePost($postId) 
    {

    }

    public function getAllPosts() 
    {

    }
}
?>
