<?php
namespace src\dal\implementations;

use src\dal\BaseDAO;
use src\dal\interfaces\UserDAO;
use src\models\User;
use config\Database;

class UserDAOImpl extends BaseDAO implements UserDAO {
    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    public function createUser($username, $password, $email) 
    {
        // Hash the password before storing it using password_hash() with standard crypt()
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (username, password, email) 
                VALUES (:username, :password, :email)";
        $params = [
            ':username' => $username,
            ':password' => $hashedPassword,
            ':email'    => $email,
        ];
        $this->executeQuery($query, $params);
    }

    public function verifyUser($username, $password) : ?User
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return new User($user['user_id'], $user['username'], $user['password'], $user['email']);
        }
        return null; // Return null if authentication fails
    }


    // Need to do: Validate and handle if there isn't a user with the given id
    public function getUserById($userId) : User
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();
        return new User($user['user_id'], $user['username'], $user['password'], $user['email']);
    }

    // Validate and handle if there isn't a user with the given username
    public function getUserByUsername($username) : User
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();
        return new User($user['user_id'], $user['username'], $user['password'], $user['email']);
    }

    public function updateUser($userId, $username, $password, $email) 
    {
        $hasedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE users
                  SET username = :username,
                      password = :password,
                      email = :email
                  WHERE user_id = :user_id";
        $params = [
            ':username' => $username,
            ':password' => $hasdPassword,
            ':email'    => $email,
            ':user_id'  => $userId,
        ];
        $this->executeQuery($query, $params);
    }

    public function deleteUser($userId) 
    {
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        $this->executeQuery($query, $params);
    }

    public function getUsername($userId) 
    {
        $query = "SELECT username FROM users WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        $stmt = $this->executeQuery($query, $params);
        $username = $stmt->fetch();
        return $username['username'];
    }

    public function getPassword($userId) : string
    {
        $query = "SELECT password FROM users WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        $stmt = $this->executeQuery($query, $params);
        $password = $stmt->fetch();
        return $password['password']; // Return hasded password
    }

    public function getAllUsers() : array
    {
        $query = "SELECT * FROM users";
        $stmt = $this->executeQuery($query);
        $rows = $stmt->fetchAll();
        $users = [];
        foreach ($rows as $row) {
            $users[] = new User($row['user_id'], $row['username'], $row['password'], $row['email']);
        }
        return $users;
    }

    public function updatePassword($userId, $newPassword) 
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password = :password WHERE user_id = :user_id";
        $params = [
            ':password' => $hashedPassword,
            ':user_id'  => $userId
        ];
        $this->executeQuery($query, $params);
    }

}
?>
