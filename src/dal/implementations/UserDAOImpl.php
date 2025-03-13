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
        $query = "INSERT INTO users (username, password, email) 
                VALUES (:username, :password, :email)";
        $params = [
            ':username' => $username,
            ':password' => $password,
            ':email'    => $email,
        ];
        $this->executeQuery($query, $params);
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
        $query = "UPDATE users
                  SET username = :username,
                      password = :password,
                      email = :email
                  WHERE user_id = :user_id";
        $params = [
            ':username' => $username,
            ':password' => $password,
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
}
?>
