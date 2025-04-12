<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\ModuleDAOImpl;
use src\utils\SessionManager;
use src\utils\Utils;

class AdminController {
    private $userDAO;
    private $postDAO;
    private $moduleDAO;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
        $this->postDAO = new PostDAOImpl();
        $this->moduleDAO = new ModuleDAOImpl();
    }

    private function checkIsAdmin()
    {
        $user = SessionManager::get('user');
    
        if (!$user || !$user->getIsAdmin()) {
            header("Location: /forum/public/");
            exit();
        }
    }
    public function showDashboard()
    {
        $this->checkIsAdmin();
    
        $title = "Admin Dashboard";
    
        // Pagination setup
        $limit = 9; // numbers of user will be taken
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get page number from URL, default to 1
        $offset = ($page - 1) * $limit; // Calculate where to start loading users from
    
        // Get a limited list of users based on pagination
        $users = $this->userDAO->getUsersPaginated($limit, $offset); // get $limit number of users, starting from $offest
        // Get total number of users to calculate how many pages are needed
        $totalUsers = $this->userDAO->getTotalUser();
        $totalPages = ceil($totalUsers / $limit); // Round up to full number of pages
    
        require_once __DIR__ . "/../views/admins/adminUserList.html.php";
    }
    
    public function showPostList()
    {
        $this->checkIsAdmin();

        $title = 'List of posts';
        // Pagination setup
        $limit = 9; // numbers of user will be taken
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get page number from URL, default to 1
        $offset = ($page - 1) * $limit; // Calculate where to start loading users from
    
        // Get a limited list of users based on pagination
        $posts = $this->postDAO->getpostsPaginated($limit, $offset); // get $limit number of users, starting from $offest
        // Get total number of users to calculate how many pages are needed
        $totalPosts = $this->postDAO->getTotalPost();
        $totalPages = ceil($totalPosts / $limit); // Round up to full number of pages

        require_once __DIR__ . "/../views/admins/postList.html.php";
    }

    public function showModuleList()
    {
        $this->checkIsAdmin();

        $title = 'List of module';
        // // Pagination setup
        $limit = 9; // numbers of user will be taken
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get page number from URL, default to 1
        $offset = ($page - 1) * $limit; // Calculate where to start loading users from
    
        // Get a limited list of users based on pagination
        $modules = $this->moduleDAO->getModulesPaginated($limit, $offset); // get $limit number of users, starting from $offest
        // Get total number of users to calculate how many pages are needed
        $totalModules = $this->moduleDAO->getTotalModule();
        $totalPages = ceil($totalModules / $limit); // Round up to full number of pages

        $postCounts = [];
        foreach ($modules as $module) {
            $moduleId = $module->getModuleId();
            $postCounts[$moduleId] = $this->moduleDAO->getTotalPostOfModuleId($moduleId);
        }

        require_once __DIR__ . "/../views/admins/adminModuleList.html.php";
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

    public function getTotalPost()
    {
        return $totalPost = $this->postDAO->getTotalPost();
    }

    public function getTotalModule()
    {
        return $totalModule = $this->moduleDAO->getTotalModule();
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