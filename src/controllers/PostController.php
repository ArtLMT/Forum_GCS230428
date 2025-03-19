<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\UserDAOImpl;
use src\utils\Validation;

class PostController {
    private $postDAO;

    public function __construct() {
        $this->postDAO = new PostDAOImpl();
    }

    // List all posts
    public function listPosts() {
        $userDAO = new UserDAOImpl();

        $posts = $this->postDAO->getAllPosts();

        foreach($posts as $post) {
            $userId = $post->getUserId();
            $username = $userDAO->getUsername($userId);
            $post->username = $username;
        }

        require_once __DIR__ . '/../views/posts/postList.html.php';
    }

    // Create a new post with validation
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title    = $_POST['title'];
            $content  = $_POST['content'];
            $userId   = $_POST['user_id'];
            $moduleId = $_POST['module_id'];

            //  Validate user_id and module_id
            if (!Validation::checkUserById($userId)) {
                echo "Error: Invalid User ID.";
                return;
            }

            if (!Validation::checkModuleById($moduleId)) {
                echo "Error: Invalid Module ID.";
                return;
            }

            // Handle image upload (unchanged)
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName    = $_FILES['image']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
            
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    
                    $uploadFileDir = realpath(__DIR__ . '/../../public/uploads');
                    if (!$uploadFileDir) {
                        die("Upload directory not found.");
                    }
                    $dest_path = $uploadFileDir . DIRECTORY_SEPARATOR . $newFileName;
                    
                    if(move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imagePath = "uploads/" . $newFileName;
                    } else {
                        echo "Error moving the uploaded file.";
                        return;
                    }
                } else {
                    echo "Upload failed. Allowed file types: " . implode(',', $allowedExtensions);
                    return;
                }
            }
            
            //  Create the post
            $this->postDAO->createPost($title, $content, $userId, $moduleId, $imagePath);

            header("Location: /forum/public/");
            exit();
        } else {
            require_once __DIR__ . '/../views/posts/createPost.html.php';
        }
    }  

    // Update an existing post with validation
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId   = $_POST['post_id'];
            $title    = $_POST['title'];
            $content  = $_POST['content'];
            $moduleId = $_POST['module_id'];

            // Avoid nesting if statements
            if (!Validation::checkPostById($postId)) {
                echo "Error: Invalid Post ID.";
                return;
            }

            if (!Validation::checkModuleById($moduleId)) {
                echo "Error: Invalid Module ID.";
                return;
            }

            // Handle image update
            $removeImage = isset($_POST['remove_image']) && $_POST['remove_image'] === '1';
            $imagePath = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName    = $_FILES['image']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

                    $uploadDir = realpath(__DIR__ . '/../../public/uploads');
                    if (!$uploadDir) {
                        die("Upload directory not found.");
                    }
                    $destPath = $uploadDir . DIRECTORY_SEPARATOR . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $imagePath = "uploads/" . $newFileName;
                    } else {
                        echo "Error moving the uploaded file.";
                        return;
                    }
                } else {
                    echo "Upload failed. Allowed file types: " . implode(',', $allowedExtensions);
                    return;
                }
            }

            if ($removeImage && !$imagePath) {
                $imagePath = '';
            }

            $this->postDAO->updatePost($postId, $title, $content, $moduleId, $imagePath);

            header("Location: /forum/public/");
            exit();
        } else {
            $postId = $_GET['id'] ?? null;
            if ($postId) {
                $post = $this->postDAO->getPostById($postId);
                require_once __DIR__ . '/../views/posts/post/updatePost.html.php';
            } else {
                echo "Post ID not provided.";
            }
        }
    }

    // Delete a post with validation
    public function delete() {
        $postId = $_GET['id'] ?? null;

        if (!$postId || !Validation::checkPostById($postId)) {
            echo "Error: Invalid Post ID.";
            return;
        }

        $this->postDAO->deletePost($postId);
        header("Location: /forum/public/");
        exit();
    }
}
?>