<?php
namespace src\dal\interfaces;

interface UserDAO {
    // public function createUser(user $user); // This function is more flexible than the one below, as it accepts a user object as a parameter
    //  This function is less flexible than the one above, as it only accepts three parameters, hard to maintain and improve
    public function createUser($username, $password, $email);
    public function getUserById($userId): ?User;
    public function getUserByEmail($email): ?User;
    public function getUserByUsername($username): ?User;
    public function editUser($username, $password, $email, $userId, $imagePath);
    public function deleteUser($userId);
    public function getUsername($userId);
    public function getPassword($userId): string;
    public function setUserIsAdmin($userId, $userIsAdmin);
    public function getAllUsers(): array;
    public function updatePassword($userId, $newPassword);
    public function getTotalUser();
    public function getUsersPaginated($limit, $offset): array;
}
?>
