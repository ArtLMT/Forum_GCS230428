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
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
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
    public function getUserById($userId) : ?User
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();

        if (!$user) {
            return null; // Return null if user is not found
        }

        return new User(
            $user['username'],
            $user['password'],
            $user['email'],
            $user['user_id'],
            $user['timestamp'] ?? null,
            $user['image_path'] ?? null,
            $user['is_admin'] ?? 0
        );
    }

    public function getUserByEmail($email): ?User 
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->executeQuery($query, [':email' => $email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return new User(
            $data['username'],
            $data['password'],
            $data['email'],
            $data['user_id'],
            $data['created_at'] ?? null,
            $data['image_path'] ?? null,
            $data['is_admin'] ?? 0
        );
    }
    
    // Validate and handle if there isn't a user with the given username
    public function getUserByUsername($username) : ?User
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();

        if (!$user) {
            return null;
        }

        return new User(
            $user['username'],
            $user['password'],
            $user['email'],
            $user['user_id'],
            $user['timestamp'] ?? null,
            $user['image_path'] ?? null,  // Include the image path
            $user['is_admin'] ?? 0
        );
        
    }

    public function editUser($username, $password, $email, $userId, $imagePath) 
    {
        // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE users
                  SET username = :username,
                      password = :password,
                      email = :email,
                      image_path = :image_path
                  WHERE user_id = :user_id";
        $params = [
            ':username' => $username,
            ':password' => $password,
            ':email'    => $email,
            ':user_id'  => $userId,
            ':image_path' => $imagePath
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
            $users[] = new User(
                $row['username'], 
                $row['password'], 
                $row['email'], 
                $row['user_id'],
                $row['timestamp'] ?? null,
                $row['image_path'] ?? null, // Include image_path
                $row['is_admin'] ?? 0
            );
        }
        return $users;
    }
    

    public function updatePassword($userId, $newPassword) 
    {
        // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $query = "UPDATE users SET password = :password WHERE user_id = :user_id";
        $params = [
            ':password' => $newPassword,
            ':user_id'  => $userId
        ];
        $this->executeQuery($query, $params);
    }

    public function getTotalUser()
    {
        $query = "SELECT COUNT(user_id) AS total FROM users";
        $stmt = $this->executeQuery($query);
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total']; // This returns just the number
    }

    public function getUsersPaginated($limit, $offset): array
    {
        $query = "SELECT * FROM users LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();
    
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $users = [];
    
        foreach ($rows as $row) {
            $users[] = new User(
                $row['username'], 
                $row['password'], 
                $row['email'], 
                $row['user_id'],
                $row['timestamp'] ?? null,
                $row['image_path'] ?? null, 
                $row['is_admin'] ?? 0
            );
        }
    
        return $users;
    }
    
}
?>
