<?php
namespace src\dal\implementations;

use src\dal\interfaces\PostDAO;
use src\models\Post;
use src\config\Database;

class PostDAOImpl implements PostDAO {
    private $pdo;
    private $post;


    public function __construct() {
        $this->pdo = Database::getConnection();
        $this->post = new Post();
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
