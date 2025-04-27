<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\ModuleDAOImpl;
use src\controllers\ModuleController;
use src\controllers\UserController;
use src\controllers\CommentController;
use src\utils\Validation;
use src\utils\SessionManager;
use src\utils\Utils;

class PostController {
    private $postDAO;

    public function __construct() {
        $this->postDAO = new PostDAOImpl();
    }

    public function isLoggedIn()
    {
        $currentUser = SessionManager::get('user');
        if ($currentUser === null) {
            $errors['unauth'] = 'You need to login to access this page.';
            SessionManager::set('errors', $errors);
            header("Location: /forum/public/login");
            exit();
        }
    }

    // GET /posts - List all posts
    public function index() 
    {
        $this->isLoggedIn();
        $posts = $this->postDAO->getAllPosts();
        // $userController = new UserController();
        
        require_once __DIR__ . '/../views/posts/postList.html.php';
    }

    // GET /posts/create - Show form for creating a post
    public function createPost() 
    {
        $this->isLoggedIn();
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
        $moduleId = $_POST['module_id'];

        $currentUser = SessionManager::get('user');
        $userId = $currentUser->getUserId();

        // Handle file upload
        $imagePath = Utils::handleImageUpload($_FILES['image'], realpath(__DIR__ . '/../../public/uploads/postAsset'));

        // Store post
        $this->postDAO->createPost($title, $content, $userId, $moduleId, $imagePath);
        header("Location: /forum/public/");
    }

    // GET /posts/{id}/edit - Show edit form
    public function edit() 
    {
        $this->isLoggedIn();
        $postId = $_GET['id'] ?? null;

        if (!Validation::validateNotEmpty($postId)) {
            $message = "Oops! Post ID not provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        if (!Validation::checkPostById($postId)) {
            $message = "Oops! The post you're looking for doesn't exist.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $post = $this->postDAO->getPostById($postId);
        $title = $post->getTitle();
        $content = $post->getContent();

        $currentUser = SessionManager::get('user');
        $currentUserId = $currentUser->getUserId();

        if ($post->getUserId() !== $currentUserId)
        {
            $message = "Oops! You're not authorized to edit this post.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }
        
        $moduleController= new ModuleController();
        $modules = $moduleController->getAllModules();

        require_once __DIR__ . '/../views/posts/updatePost.html.php';

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
    
        if (!Validation::validateNotEmpty($postId) || !Validation::checkPostById($postId)) {
            $message = "Oops! Invalid Post ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }
        
        if (!Validation::validateNotEmpty($moduleId) || !Validation::checkModuleById($moduleId)) {
            $message = "Oops! Invalid Module ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
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

        if (!Validation::validateNotEmpty($postId) || !Validation::checkPostById($postId)) {
            $message = "Oops! Invalid Post ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
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
        $this->isLoggedIn();
        // post asset:
        $postId = $_GET['post_id'];

        if (!Validation::validateNotEmpty($postId))
        {
            $message = "Please input the post's Id";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        if (!Validation::checkPostById($postId)) {
            $message = "Oops! The post you're looking for doesn't exist.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }
        

        $commentDAO = new CommentController();
        $comments = $commentDAO->getcomment($postId);
        $post = $this->postDAO->getPostById($postId);
        $postImage = $post->getPostImage();
        $postContent = $post->getContent();
        $postTitle = $post->getTitle();
        $postDate = $post->getPostedTime();

        
        $username = $post->getUsername();
        $userImage = $post->getUserImage();
        $ownerId = $post->getUserId();

        $firstLetter = strtoupper(substr($username, 0, 1)); // Get first letter and make it uppercase

        $currentUser = SessionManager::get('user');
        $currentUserId = $currentUser->getUserId();
        $currentUserIsAdmin = $currentUser->getIsAdmin();

        require_once __DIR__ . '/../views/posts/postInDetail.html.php';
    }    

    
    public function showPostByModule()
    {
        $this->isLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleId = $_GET['id'] ?? null;

        if (!Validation::validateNotEmpty($moduleId) || !Validation::checkModuleById($moduleId)) {
            $message = "Oops! Invalid Module ID provided.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }
        
        $posts = $this->postDAO->getPostsByModuleId($moduleId);
        
        $moduleDAO = new ModuleDAOImpl();
        $module = $moduleDAO->getModuleById($moduleId);

        require_once __DIR__ . '/../views/posts/postListByModule.html.php';

    }
}
?>