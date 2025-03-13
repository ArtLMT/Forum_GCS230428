<?php
namespace src\dal\implementations;

use src\dal\interfaces\UserDAO;
use src\config\Database;
use src\models\User;

class UserDAOImpl implements UserDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection(); // Use Database connection
    }

    public function createUser($username, $password, $email) 
    {

    }

    public function getUserById($userId) 
    {

    }

    public function getUserByUsername($username) 
    {

    }

    public function updateUser($userId, $username, $password, $email) 
    {

    }

    public function deleteUser($userId) 
    {

    }
}
?>
