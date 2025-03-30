<?php
namespace src\dal\implementations;

use config\Database;
use src\dal\BaseDAO;
use src\dal\interfaces\AuthDAO;
use src\models\User;
// use PDO;

class AuthDAOImpl extends BaseDAO implements AuthDAO {
    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->getConnection();
    }

    public function getUserByEmail($email): ?User {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->executeQuery($query, [':email' => $email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $data ? $this->mapToUser($data) : null;
    }

    public function createUser($username, $email, $passwordHash) {
        $query = "INSERT INTO users (username, email, password) 
                  VALUES (:username, :email, :password)";
        $params = [
            ':username' => $username,
            ':email'    => $email,
            ':password' => $passwordHash
        ];
        $this->executeQuery($query, $params);
    }

    public function verifyUserCredentials($email, $password): bool {
        $user = $this->getUserByEmail($email);
        return $user && password_verify($password, $user->getPassword());
    }

    private function mapToUser($data): User {
        return new User(
            $data['username'],
            $data['password'],
            $data['email'],
            $data['user_id'],
            $data['created_at'] ?? null
        );
    }
}
?>
