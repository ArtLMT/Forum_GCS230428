<?php
// require_once __DIR__ . "/Database.php";

// class User {
//     private $pdo;

//     public function __construct() {
//         $this->conn = Database::getInstance()->getConnection();
//     }

//     public function createUser($username, $email, $password) {
//         $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//         $sql = "INSERT INTO Users (username, email, password) VALUES (:username, :email, :password)";
//         $stmt = $this->conn->prepare($sql);
//         return $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword]);
//     }

//     public function getUserById($userId) {
//         $sql = "SELECT * FROM Users WHERE user_id = :user_id";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute(['user_id' => $userId]);
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }

//     public function checkLogin($email, $password) {
//         $sql = "SELECT * FROM Users WHERE email = :email";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute(['email' => $email]);
//         $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
//         if ($user && password_verify($password, $user['password'])) {
//             return $user;
//         }
//         return false;
//     }
// }
?>
