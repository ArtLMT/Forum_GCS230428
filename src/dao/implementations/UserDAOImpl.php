<?php
namespace src\dao\implementations;

require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../interfaces/UserDAO.php";
require_once __DIR__ . "/../../models/User.php";

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
