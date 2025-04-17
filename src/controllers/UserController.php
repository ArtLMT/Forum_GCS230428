<?php
namespace src\controllers;

use src\dal\implementations\UserDAOImpl;
use src\dal\implementations\PostDAOImpl;
use src\controllers\PostController;
use src\utils\SessionManager;
use src\utils\Utils;
use src\utils\Validation;

class UserController {
    private $userDAO;
    private $postDAO;

    public function __construct() {
        $this->userDAO = new UserDAOImpl();
        $this->postDAO = new PostDAOImpl();
    }
    
    public function index()
    {
        $this->isLoggedIn();
        $title = "User List";

        // Pagination setup
        $limit = 6; // numbers of user will be taken
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get page number from URL, default to 1
        $offset = ($page - 1) * $limit; // Calculate where to start loading users from
    
        // Get a limited list of users based on pagination
        $users = $this->userDAO->getUsersPaginated($limit, $offset); // get $limit number of users, starting from $offest
        // Get total number of users to calculate how many pages are needed
        $totalUsers = $this->userDAO->getTotalUser();
        $totalPages = ceil($totalUsers / $limit); // Round up to full number of pages

        $postCounts = [];
        foreach ($users as $user) {
            $userId = $user->getUserId();
            $postCounts[$userId] = $this->postDAO->countPostByUser($userId);
        }

        require_once __DIR__ . '/../views/users/userList.html.php'; // for the layout
    }

    public function createUser() 
    {
        $this->isLoggedIn();
        require_once __DIR__ . '/../views/auth/signInForm.html.php';
    }

    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // ← Hashed here
            $email = $_POST['email'];

            $checkEmail = $this->userDAO->getUserByEmail($email);
            $errors = [];

            // Check if username is not empty
            if (!Validation::validateNotEmpty($username)) {
                $errors['username'] = "Username is required.";
            }

            // Check if email already exists
            if (Validation::checkUserByEmail($email)) {
                $errors['duplicateEmail'] = "This email is already used.";
            }

            // Check password strength
            if (empty($password)) {
                $errors["password"] = "Password cannot be empty";
            } elseif (strlen($password) < 8) {
                $errors["password"] = "Password must be at least 8 characters long";
            }

            if($errors) {
                SessionManager::set('errors', $errors);
                header("Location: /forum/public/signIn"); // Redirect back to login
                exit();
            }
    
            $this->userDAO->createUser($username, $hashedPassword, $email);
    
            SessionManager::start();
            $user = $this->userDAO->getUserByEmail($email);
    
            SessionManager::set('user', $user);
            SessionManager::set('username', $user->getUsername());
            
            header("Location: /forum/public/");
        }
    }
    

    public function editUser() 
    {
        $this->isLoggedIn();

        $title = "Editing user";
        $userId = $_GET['user_id'];
        $user = $this->userDAO->getUserById($userId);
        require_once __DIR__ . '/../views/users/editUser.html.php';
    }

    public function updateUser() 
    {
        SessionManager::start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'];
            $username = $_POST['username'];
            $oldPassword = $_POST['oldPassword'];
            $password = $_POST['password'];
            $checkPassword = $_POST['verifyPassword'];

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $email = $_POST['email'];
            $removeImage = isset($_POST['remove_image']) ? true : false;

            $user = $this->userDAO->getUserById($userId);

            $errors = [];
            if (!empty($password) || !empty($checkPassword) || !empty($oldPassword)) {
                // Check if confirm password matches
                if ($password !== $checkPassword) {
                    $errors['password'] = "The new password doesn't match the confirmation.";
                }
    
                // Check if old password is correct
                if (!password_verify($oldPassword, $user->getPassword())) {
                    $errors['oldPassword'] = "Old password is incorrect.";
                }

                if (!empty($errors)) {
                    // Store errors in session and redirect back to form
                    SessionManager::set('form_errors', $errors);
                    SessionManager::set('form_data', $_POST); // Optional: to keep the inputs
                    header("Location: /forum/public/updateUser?user_id=$userId");
                    exit;
                }
                
                // Hash new password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            } else {
                // If user didn't change password, keep the old hash
                $hashedPassword = $user->getPassword();
            }

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

            $this->userDAO->editUser($username, $hashedPassword, $email, $userId, $imagePath);
            // if currentUser is updated, update it to the view
            if ($userId == SessionManager::get('user')->getUserId()) {
                $updatedUser = $this->userDAO->getUserById($_POST['user_id']);
                $_SESSION['user'] = $updatedUser;
            }
            
            header("Location: /forum/public/showProfile?id=$userId");
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
        $this->isLoggedIn();
        $userId = $_GET['id'];
        // user asset:
        $user = $this->userDAO->getUserById($userId);
        $userImage = $user->getUserImage();
        $userName = $user->getUserName($userId);
        $password = $user->getPassword();
        $userMail = $user->getEmail();

        $authController = new AuthController();
        $postControl = new PostController();
        $isOwner = $authController->isOwner($userId);

        $posts = $postControl->getPostByUserId($userId);


        require_once __DIR__ . '/../views/users/profile.html.php';
    }

    public function getUser($userId)
    {
        return $this->userDAO->getUserById($userId);
    }

    public function getUserByEmail($email)
    {
        return $this->userDAO->getUserByEmail($email);
    }

    public function getTotalUser()
    {
        return $this->userDAO->getTotalUser();
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
}
?>