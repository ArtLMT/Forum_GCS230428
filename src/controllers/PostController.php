<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\ModuleDAOImpl;
use src\utils\Validation;

class PostController {
    private $postDAO;

    public function __construct() {
        $this->postDAO = new PostDAOImpl();
    }

    // GET /posts - List all posts
    public function index() {
        $posts = $this->postDAO->getAllPosts();
        require_once __DIR__ . '/../views/posts/postList.html.php';
    }

    // GET /posts/create - Show form for creating a post
    public function createPost() {
        $moduleDAO = new ModuleDAOImpl();
        $modules = $moduleDAO->getAllModules();
        require_once __DIR__ . '/../views/posts/createPost.html.php';
    }

    // POST /posts - Store a new post
    public function store() {
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
        $imagePath = $this->handleImageUpload();

        // Store post
        $this->postDAO->createPost($title, $content, $userId, $moduleId, $imagePath);
        header("Location: /forum/public/");
        exit();
    }

    // GET /posts/{id}/edit - Show edit form
    public function edit() {
        $postId = $_GET['id'] ?? null;
        if ($postId) {
            $post = $this->postDAO->getPostById($postId);
            require_once __DIR__ . '/../views/posts/updatePost.html.php';
        } else {
            echo "Post ID not provided.";
        }
    }

    // PUT/PATCH /posts/{id} - Update an existing post
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $postId   = $_POST['post_id'];
        $title    = $_POST['title'];
        $content  = $_POST['content'];
        $moduleId = $_POST['module_id'];

        if (!Validation::checkPostById($postId)) {
            echo "Error: Invalid Post ID.";
            return;
        }

        if (!Validation::checkModuleById($moduleId)) {
            echo "Error: Invalid Module ID.";
            return;
        }

        // Handle file upload
        $imagePath = $this->handleImageUpload();

        // Update post
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

    // Private helper function for image upload
    private function handleImageUpload() {
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath  = $_FILES['image']['tmp_name'];
            $fileName     = $_FILES['image']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadDir = realpath(__DIR__ . '/../../public/uploads/postAsset');

                if (!$uploadDir) {
                    die("Upload directory not found.");
                }

                $destPath = $uploadDir . DIRECTORY_SEPARATOR . $newFileName;
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $imagePath = "uploads/postAsset/" . $newFileName;
                } else {
                    echo "Error moving the uploaded file.";
                    return null;
                }
            } else {
                echo "Invalid file type.";
                return null;
            }
        }
        return $imagePath;
    }
}
?>
