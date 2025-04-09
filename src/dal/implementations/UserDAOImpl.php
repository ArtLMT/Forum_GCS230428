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

    private function mapRowToUser(array $row): User
    {
        return new User(
            $row['username'],
            $row['password'],
            $row['email'],
            $row['user_id'],
            $row['timestamp'] ?? $row['created_at'] ?? null,
            $row['image_path'] ?? null,
            $row['is_admin'] ?? 0
        );
    }

    private function mapRowsToUsers(array $rows): array
    {
        $users = [];
        foreach ($rows as $row) {
            $users[] = $this->mapRowToUser($row);
        }
        return $users;
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

    public function getUserById($userId) : ?User
    {
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();

        return $user ? $this->mapRowToUser($user) : null;
    }

    public function getUserByEmail($email): ?User 
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->executeQuery($query, [':email' => $email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $data ? $this->mapRowToUser($data) : null;
    }

    public function getUserByUsername($username) : ?User
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $params = [':username' => $username];
        $stmt = $this->executeQuery($query, $params);
        $user = $stmt->fetch();

        return $user ? $this->mapRowToUser($user) : null;
    }

    public function editUser($username, $password, $email, $userId, $imagePath) 
    {
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
        return $password['password'];
    }

    public function getAllUsers() : array
    {
        $query = "SELECT * FROM users"; 
        $stmt = $this->executeQuery($query);
        $rows = $stmt->fetchAll();
        return $this->mapRowsToUsers($rows);
    }

    public function updatePassword($userId, $newPassword) 
    {
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
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    public function getUsersPaginated($limit, $offset): array
    {
        $query = "SELECT * FROM users LIMIT :limit OFFSET :offset";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->mapRowsToUsers($rows);
    }
}
?>
