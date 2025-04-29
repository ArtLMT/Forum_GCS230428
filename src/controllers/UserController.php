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

        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;
    
        $users = $this->userDAO->getUsersPaginated($limit, $offset);
        $totalUsers = $this->userDAO->getTotalUser();
        $totalPages = ceil($totalUsers / $limit);

        $postCounts = [];
        foreach ($users as $user) {
            $userId = $user->getUserId();
            $postCounts[$userId] = $this->postDAO->countPostByUser($userId);
        }

        require_once __DIR__ . '/../views/users/userList.html.php';
    }

    public function createUser() 
    {
        $this->isLoggedIn();
        require_once __DIR__ . '/../views/auth/signInForm.html.php';
    }

    public function store() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $errors = [];

        if (!Validation::validateNotEmpty($username)) {
            $errors['username'] = "Username is required.";
        }

        if (!Validation::validateNotEmpty($email)) {
            $errors['email'] = "A valid email is required.";
        }

        if (Validation::checkUserByEmail($email)) {
            $errors['duplicateEmail'] = "This email is already used.";
        }

        if (!Validation::validateNotEmpty($password)) {
            $errors['password'] = "Password is required.";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters long.";
        }

        if (!empty($errors)) {
            SessionManager::set('errors', $errors);
            header("Location: /forum/public/signIn");
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->userDAO->createUser($username, $hashedPassword, $email);

        SessionManager::start();
        $user = $this->userDAO->getUserByEmail($email);

        SessionManager::set('user', $user);
        SessionManager::set('username', $user->getUsername());

        header("Location: /forum/public/");
    }

    public function editUser() 
    {
        $this->isLoggedIn();

        $userId = $_GET['user_id'] ?? null;

        if (!Validation::validateNotEmpty($userId) || !Validation::checkUserById($userId)) {
            $message = "Invalid or missing User ID.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $currentUser = SessionManager::get('user');
        $currentUserId = $currentUser->getUserId();

        if ($userId != $currentUserId)
        {
            $message = "Oops! You're not authorized to edit this user.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $user = $this->userDAO->getUserById($userId);
        $title = "Editing user";

        require_once __DIR__ . '/../views/users/editUser.html.php';
    }

    public function updateUser() 
    {
        SessionManager::start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $userId = $_POST['user_id'];

        if (!Validation::validateNotEmpty($userId) || !Validation::checkUserById($userId)) {
            echo "Invalid User ID.";
            return;
        }

        $username = $_POST['username'];
        $oldPassword = $_POST['oldPassword'];
        $password = $_POST['password'];
        $checkPassword = $_POST['verifyPassword'];
        $email = $_POST['email'];
        $removeImage = isset($_POST['remove_image']) ? true : false;

        $user = $this->userDAO->getUserById($userId);

        $errors = [];

        if (!Validation::validateNotEmpty($username)) {
            $errors['username'] = "Username cannot be empty.";
        }

        if (!Validation::validateNotEmpty($email)) {
            $errors['email'] = "A valid email is required.";
        }

        if (!empty($password) || !empty($checkPassword) || !empty($oldPassword)) {
            if ($password !== $checkPassword) {
                $errors['password'] = "New password and confirmation do not match.";
            }

            if (!password_verify($oldPassword, $user->getPassword())) {
                $errors['oldPassword'] = "Old password is incorrect.";
            }

            if (!empty($errors)) {
                SessionManager::set('form_errors', $errors);
                SessionManager::set('form_data', $_POST);
                header("Location: /forum/public/updateUser?user_id=$userId");
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashedPassword = $user->getPassword();
        }

        $existingImage = $user->getUserImage();
        $imagePath = Utils::handleImageUpload($_FILES['image'], realpath(__DIR__ . '/../../public/uploads/userAsset'));

        if ($removeImage && $existingImage) {
            Utils::deleteImage($existingImage);
            $imagePath = null;
        } elseif (!$imagePath) {
            $imagePath = $existingImage;
        }

        $this->userDAO->editUser($username, $hashedPassword, $email, $userId, $imagePath);

        if ($userId == SessionManager::get('user')->getUserId()) {
            $updatedUser = $this->userDAO->getUserById($userId);
            $_SESSION['user'] = $updatedUser;
        }

        header("Location: /forum/public/showProfile?id=$userId");
    }

    public function deleteUser() 
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }

        $userId = $_POST['user_id'] ?? null;

        if (!Validation::validateNotEmpty($userId) || !Validation::checkUserById($userId)) {
            echo "Error: Invalid User ID.";
            return;
        }

        $this->userDAO->deleteUser($userId);
        header("Location: /forum/public/userLists");
        exit();
    }

    public function showProfile() 
    {
        $this->isLoggedIn();

        $userId = $_GET['id'] ?? null;

        if (!Validation::validateNotEmpty($userId) || !Validation::checkUserById($userId)) {
            $message = "Invalid or missing User ID.";
            require_once __DIR__ . '/../views/error/displayError.html.php';
            exit();
        }

        $user = $this->userDAO->getUserById($userId);

        $userImage = $user->getUserImage();
        $userName = $user->getUserName();
        $password = $user->getPassword();
        

        $authController = new AuthController();
        $postControl = new PostController();
        $isOwner = $authController->isOwner($userId);

        $postNumber = 0;

        $posts = $postControl->getPostByUserId($userId);
        foreach ($posts as $post) {
            $postNumber += 1;
        }

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
