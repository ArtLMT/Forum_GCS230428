<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\ModuleDAOImpl;
use src\controllers\UserController;
use src\utils\Validation;
use src\utils\Utils;

class PostController {
    private $postDAO;

    public function __construct() {
        $this->postDAO = new PostDAOImpl();
    }

    // GET /posts - List all posts
    public function index() 
    {
        $posts = $this->postDAO->getAllPosts();
        require_once __DIR__ . '/../views/posts/postList.html.php';
    }

    // GET /posts/create - Show form for creating a post
    public function createPost() 
    {
        $moduleDAO = new ModuleDAOImpl();
        $modules = $moduleDAO->getAllModules();
        require_once __DIR__ . '/../views/posts/createPost.html.php';
    }

    // POST /posts - Store a new post
    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $title    = $_POST['title'];
        $content  = $_POST['content'];
        $userId   = $_POST['user_id'];
        $moduleId = $_POST['module_id'];

        // Handle file upload
        $imagePath = Utils::handleImageUpload($_FILES['image'], realpath(__DIR__ . '/../../public/uploads/postAsset'));

        // Store post
        $this->postDAO->createPost($title, $content, $userId, $moduleId, $imagePath);
        header("Location: /forum/public/");
        exit();
    }

    // GET /posts/{id}/edit - Show edit form
    public function edit() 
    {
        $postId = $_GET['id'] ?? null;
        if ($postId) {
            $post = $this->postDAO->getPostById($postId);
            require_once __DIR__ . '/../views/posts/updatePost.html.php';
        } else {
            echo "Post ID not provided.";
        }
    }

    // Update an existing post
    public function update() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }
    
        $postId   = $_POST['post_id'];
        $title    = $_POST['title'];
        $content  = $_POST['content'];
        $moduleId = $_POST['module_id'];
        $removeImage = isset($_POST['remove_image']) ? true : false;
    
        if (!Validation::checkPostById($postId)) {
            echo "Error: Invalid Post ID.";
            return;
        }
    
        if (!Validation::checkModuleById($moduleId)) {
            echo "Error: Invalid Module ID.";
            return;
        }
    
        // Retrieve current post data
        $post = $this->postDAO->getPostById($postId);
        $existingImage = $post->getPostImage();
    
        // Handle file upload (new image)
        $imagePath = Utils::handleImageUpload($_FILES['image'], realpath(__DIR__ . '/../../public/uploads/postAsset'));
    
        // If user checked "Remove Image", delete old image and clear path
        if ($removeImage && $existingImage) {
            Utils::deleteImage($existingImage);
            $imagePath = null; // Clear the image in the database
        } elseif (!$imagePath) {
            // If no new image was uploaded, keep the existing image
            $imagePath = $existingImage;
        }
    
        // Update the post
        $this->postDAO->updatePost($postId, $title, $content, $moduleId, $imagePath);
        header("Location: /forum/public/");
        exit();
    }
    

    // DELETE /posts/{id} - Delete a post
    public function destroy() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $postId = $_GET['id'] ?? null;

        if (!$postId || !Validation::checkPostById($postId)) {
            echo "Error: Invalid Post ID.";
            return;
        }

        $this->postDAO->deletePost($postId);
        header("Location: /forum/public/");
        exit();
    }

    public function getPostByUserId()
    {
        $userId   = $_POST['user_id'];
        $this->postDAO->getPostByUserId($userId);
        require_once __DIR__ . '/../views/users/userPosts.html.php';
    }

    public function getPostById($postId)
    {
        return $this->postDAO->getPostById($postId);
    }

    public function openPost()
    {
        $postId   = $_GET['post_id'];
        $post = $this->getPostById($postId);

        require_once __DIR__ . '/../views/posts/postInDetail.html.php';
    }
}
?>