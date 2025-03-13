<?php
namespace src\controllers;

use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\UserDAOImpl;

class PostController {
    private $postDAO;

    public function __construct() {
        $this->postDAO = new PostDAOImpl();
    }

    // List all posts (already implemented)
    public function listPosts() {
        $userDAO = new UserDAOImpl();

        $posts = $this->postDAO->getAllPosts();

        foreach($posts as $post) {
            $userId = $post->getUserId();
            $username = $userDAO->getUsername($userId);
            $post->username = $username;
        }

        require_once __DIR__ . '/../views/postList.html.php';
    }

    // Show a form for creating a new post and handle submission.
    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title    = $_POST['title'];
            $content  = $_POST['content'];
            $userId   = $_POST['user_id'];
            $moduleId = $_POST['module_id'];
    
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName    = $_FILES['image']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
            
                // Allowed file extensions
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    
                    // Compute absolute path to the uploads folder:
                    $uploadFileDir = realpath(__DIR__ . '/../../public/uploads');
                    if (!$uploadFileDir) {
                        die("Upload directory not found.");
                    }
                    $dest_path = $uploadFileDir . DIRECTORY_SEPARATOR . $newFileName;
                    
                    if(move_uploaded_file($fileTmpPath, $dest_path)) {
                        // Store relative path (e.g., "uploads/newfilename.jpg")
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
            
            // Create the post (pass the image path as an extra parameter if needed)
            $this->postDAO->createPost($title, $content, $userId, $moduleId, $imagePath);
    
            header("Location: /Forum/public/");
            exit();
        } else {
            require_once __DIR__ . '/../views/createPost.html.php';
        }
    }
    

    // Show a form for updating a post and handle submission.
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postId   = $_POST['post_id'];
            $title    = $_POST['title'];
            $content  = $_POST['content'];
            $moduleId = $_POST['module_id'];

            // 1. Check if user wants to remove the existing image
            $removeImage = isset($_POST['remove_image']) && $_POST['remove_image'] === '1';
    
            // 2. Check if a new image file is uploaded
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName    = $_FILES['image']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
    
                // Allowed file extensions
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                if (in_array($fileExtension, $allowedExtensions)) {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    
                    // Make sure your "uploads" folder path is correct
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
    
            // 3. If user wants to remove the old image but didn't upload a new one,
            //    set $imagePath to an empty string so the DAO can set image_path = NULL
            if ($removeImage && !$imagePath) {
                // Use an empty string or a special marker to signal "remove image"
                $imagePath = '';
            }
    
            // 4. Call the DAO update method
            $this->postDAO->updatePost($postId, $title, $content, $moduleId, $imagePath);
    
            // Redirect to home after update
            header("Location: /Forum/public/");
            exit();
        } else {
            $postId = $_GET['id'] ?? null;
            if ($postId) {
                $post = $this->postDAO->getPostById($postId);
                require_once __DIR__ . '/../views/updatePost.html.php';
            } else {
                echo "Post ID not provided.";
            }
        }
    }
    // Delete a post. We can use a GET request for simplicity.
    public function delete() {
        $postId = $_GET['id'] ?? null;
        if ($postId) {
            $this->postDAO->deletePost($postId);
            header("Location: /Forum/public/");
            exit();
        } else {
            echo "Post ID not provided.";
        }
    }
}
