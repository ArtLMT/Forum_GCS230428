<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;
use src\dal\implementations\ModuleDAOImpl;
use src\dal\implementations\EmailMessageDAOImpl;
use src\utils\SessionManager;
use src\utils\Utils;

class AdminController {
    private $userDAO;
    private $postDAO;
    private $moduleDAO;
    private $emailMessageDAO;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
        $this->postDAO = new PostDAOImpl();
        $this->moduleDAO = new ModuleDAOImpl();
        $this->emailMessageDAO = new EmailMessageDAOImpl();
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
        $limit = 8; // numbers of user will be taken
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
        $limit = 8; // numbers of user will be taken
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
        $limit = 8; // numbers of user will be taken
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
        $title = "Add user";
        require_once __DIR__ . '/../views/admins/adminCreateUser.html.php';
    }

    public function showCreatePost()
    {
        $title = "Create Post";
        $modules = $this->moduleDAO->getAllModules();
        require_once __DIR__ . '/../views/admins/adminCreatePost.html.php';
    }

    public function showCreateModule()
    {
        $title = "Create module";
        require_once __DIR__ . '/../views/admins/createModule.html.php';
    }

    public function showEditModule()
    {   
        $title = "Edit module";
        $moduleId = $_GET['id'] ?? null;

        if (!$moduleId ) {
            echo "Error: Invalid Module ID.";
            return;
        }

        $module = $this->moduleDAO->getModuleById($moduleId);
        require_once __DIR__ . '/../views/admins/updateModule.html.php';
    }

    public function showFeedback()
    {
        // $messages = $this->emailMessageDAO->getAllMessage();
        $title = "List of feebacks";

        // Pagination setup
        $limit = 3; // numbers of user will be taken
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get page number from URL, default to 1
        $offset = ($page - 1) * $limit; // Calculate where to start loading users from
    
        // Get a limited list of users based on pagination
        $messages = $this->emailMessageDAO->getEmailMessagePaginated($limit, $offset); // get $limit number of users, starting from $offest
        // Get total number of users to calculate how many pages are needed
        $totalMessages = $this->emailMessageDAO->countMessages();
        $totalPages = ceil($totalMessages / $limit); // Round up to full number of pages

        require_once __DIR__ . '/../views/admins/listFeedback.html.php';
    }

    public function userEdit()
    {
        $userId = $_GET['user_id'];
        $user = $this->userDAO->getUserById($userId);
        require_once __DIR__ . '/../views/admins/editUser.html.php';
    }

    public function countTotalUser()
    {
        return $totalUser = $this->userDAO->getTotalUser();
    }

    public function countTotalPost()
    {
        return $totalPost = $this->postDAO->getTotalPost();
    }

    public function countTotalModule()
    {
        return $totalModule = $this->moduleDAO->getTotalModule();
    }

    public function countTotalEmailMessage()
    {
        return $totalEmailMessages = $this->emailMessageDAO->countMessages();
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

    public function storePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title    = $_POST['title'];
            $content  = $_POST['content'];
            $moduleId = $_POST['module_id'];

            $currentUser = SessionManager::get('user');
            $userId = $currentUser->getUserId();

            $imagePath = Utils::handleImageUpload($_FILES['image'], realpath(__DIR__ . '/../../public/uploads/postAsset'));

            $this->postDAO->createPost($title, $content, $userId, $moduleId, $imagePath);
            header("Location: /forum/public/admin/showPostList");
        }
    }

    public function storeModule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleName = $_POST['module_name'];
        $moduleDescription = $_POST['module_description'];

        $this->moduleDAO->createModule($moduleName, $moduleDescription);
        header('Location: /forum/public/admin/showModuleList');
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

    public function updateModule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleId = $_POST['module_id'];
        $moduleName = $_POST['module_name'];
        $moduleDescription = $_POST['module_description'];

        $this->moduleDAO->updateModule($moduleId, $moduleName, $moduleDescription);
        header("Location: /forum/public/admin/showModuleList");
        exit();
    }

    public function updateUserRole()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $userIsAdmin = $_POST['is_admin'];

            $newRole = $userIsAdmin ? 0 : 1;

            $this->userDAO->setUserIsAdmin($userId, $newRole);
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

    public function deletePost()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $postId = $_POST['post_id'] ?? null;

        if (!$postId) {
            echo "Error: Invalid Post ID.";
            return;
        }

        $this->postDAO->deletePost($postId);
        header("Location: /forum/public/admin/showPostList");
        exit();
    }

    public function deleteModule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $moduleId = $_POST['module_id'] ?? null;

        if (!$moduleId) {
            echo "Error: Invalid Module ID.";
            return;
        }

        $this->moduleDAO->deleteModule($moduleId);
        header("Location: /forum/public/admin/showModuleList");
        exit();
    }
}
?>