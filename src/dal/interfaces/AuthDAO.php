<?php
namespace src\dal\interfaces;

interface AuthDAO {
    public function getUserByEmail($email);
}
?>
