<?php
interface UserDAO {
    public function createUser(User $user);
    public function getUserById($userId);
    public function getUserByUsername($username);
    public function updateUser(User $user);
    public function deleteUser($userId);
}
?>
