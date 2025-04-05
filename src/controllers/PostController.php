<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\controllers\ModuleController;
use src\controllers\UserController;
use src\utils\Validation;
use src\utils\SessionManager;
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
        $userController = new UserController();
        
        require_once __DIR__ . '/../views/posts/postList.html.php';
    }

    // GET /posts/create - Show form for creating a post
    public function createPost() 
    {
        $moduleController= new ModuleController();
        $modules = $moduleController->getAllModules();
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
    public function destroy() 
    {
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

    public function getPostByUserId($userId)
    {
        return $this->postDAO->getPostByUserId($userId);
    } 

    public function openPost()
    {
        // post asset:
        $post = $this->postDAO->getPostById($_GET['post_id']);
        $postImage = $post->getPostImage();
        $postContent = $post->getContent();
        $postTitle = $post->getTitle();
        $postDate = $post->getPostedTime();
        $username = $post->getUsername();
        $userImage = $post->getUserImage();
        $ownerId = $post->getUserId();

        $firstLetter = strtoupper(substr($username, 0, 1)); // Get first letter and make it uppercase

        $currentUserId = SessionManager::get('user_id');

        require_once __DIR__ . '/../views/posts/postInDetail.html.php';
    }    
}
?>