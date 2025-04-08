<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\utils\SessionManager;
use src\utils\Utils;

class AdminController {
    private $userDAO;
    private $totalUser;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
    }

    public function showDashboard() {
        $user = SessionManager::get('user');

        if (!$user || !$user->getIsAdmin()) {
            header("Location: /forum/public/");
            exit();
        }

        $title = "Admin Dashboard";
        $users = $this->userDAO->getAllUsers();

        require_once __DIR__ . "/../views/admins/adminDashboard.html.php"; // Create this view
    }

    public function showUserCreate()
    {
        require_once __DIR__ . '/../views/admins/adminCreateUser.html.php';
    }

    public function userEdit()
    {
        $userId = $_GET['user_id'];
        $user = $this->userDAO->getUserById($userId);
        require_once __DIR__ . '/../views/admins/editUser.html.php';
    }

    public function getTotalUser()
    {
        return $totalUser = $this->userDAO->getTotalUser();
    }

    public function storeUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $this->userDAO->createUser($username, $password, $email);
            header("Location: /forum/public/dashboard");
        }
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
                header("Location: /forum/public/dashboard");
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
            header("Location: /forum/public/dashboard");
            exit();
        } else {
            echo "Invalid request method!";
        }
    }
}
?>