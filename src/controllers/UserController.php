<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\controllers\PostController;
use src\utils\SessionManager;
use src\utils\Utils;

class UserController {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
    }
    
    public function index()
    {
        $users = $this->userDAO->getAllUsers();
        require_once __DIR__ . '/../views/users/userList.html.php';
    }

    public function createUser() 
    {
        require_once __DIR__ . '/../views/users/createUser.html.php';
    }

    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->createUser($username, $password, $email);
            header("Location: /forum/public/");
        }
    }

    public function editUser() 
    {
        $userId = $_GET['user_id'];
        $user = $this->userDAO->getUserById($userId);
        require_once __DIR__ . '/../views/users/editUser.html.php';
    }

    public function updateUser() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $removeImage = isset($_POST['remove_image']) ? true : false;

            $user = $this->userDAO->getUserById($userId);
            $existingImage = $user->getUserImage();

     
            // Handle file upload (new image)
            $imagePath = Utils::handleImageUpload($_FILES['image'], realpath(__DIR__ . '/../../public/uploads/userAsset'));
        
            // If user checked "Remove Image", delete old image and clear path
            if ($removeImage && $existingImage) {
                Utils::deleteImage($existingImage);
                $imagePath = null; // Clear the image in the database
            } elseif (!$imagePath) {
                // If no new image was uploaded, keep the existing image
                $imagePath = $existingImage;
            }

                $this->userDAO->editUser($username, $password, $email, $userId, $imagePath);
                header("Location: /forum/public/userLists");
        } 
    }

    public function deleteUser() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            if (!$userId) {
                echo "Error: invalid User ID.";
                return;
            }
            
            $this->userDAO->deleteUser($userId);
            header("Location: /forum/public/userLists");
            exit();
        } else {
            echo "Invalid request method!";
        }
    }

    public function showProfile() 
    {
        $userId = $_GET['id'];
        // user asset:
        $user = $this->userDAO->getUserById($userId);
        $userImage = $user->getUserImage();
        $userName = $user->getUserName($userId);
        $password = $user->getPassword();
        $userMail = $user->getEmail();

        $authController = new AuthController();
        $postControl = new PostController();

        $posts = $postControl->getPostByUserId($userId);

        // $isOwner = $user === $currentUser ? true : false;

        require_once __DIR__ . '/../views/users/profile.html.php';
    }

    public function getCurrentUser() 
    {
        $userId = SessionManager::get('user_id');
        if ($userId) {
            return $this->userDAO->getUserById($userId);
        }
        return null;
    }

    public function getUser($userId)
    {
        return $this->userDAO->getUserById($userId);
    }

    public function getUserByEmail($email)
    {
        return $this->userDAO->getUserByEmail($email);
    }
}
?>