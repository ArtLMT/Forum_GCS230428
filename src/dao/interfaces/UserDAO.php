<?php
namespace src\dao\interfaces;

interface UserDAO {
    public function createUser(user $user); // This function is more flexible than the one below, as it accepts a user object as a parameter
    //  This function is less flexible than the one above, as it only accepts three parameters, hard to maintain and improve
    //  public function createUser($username, $password, $email); 
    public function getUserById($userId);
    public function getUserByUsername($username);
    public function updateUser($userId, $username, $password, $email);
    public function deleteUser($userId);
}
?>
