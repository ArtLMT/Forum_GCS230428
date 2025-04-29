<?php
namespace src\models;

class User {
    private $userId;
    private $username;
    private $password;
    private $email;
    private $createDate;
    private $image_path;
    private $isAdmin;
    
    public function __construct(
        $username,  // Required
        $password,  // Required
        $email,  // Required
        $userId = null, 
        $createDate = null,
        $image_path = null,
        $isAdmin = 0
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->userId = $userId;
        $this->email = $email;
        $this->createDate = $createDate;
        $this->image_path = $image_path;
        $this->isAdmin = $isAdmin;
    }

    public function getUserId() 
    {
        return $this->userId;
    }

    public function setUserId($userId) 
    {
        $this->userId = $userId;
    }

    public function getUsername() 
    {
        return $this->username;
    }

    public function setUsername($username) 
    {
        $this->username = $username;
    }

    public function getPassword() 
    {
        return $this->password;
    }

    public function setPassword($password) 
    {
        $this->password = $password;
    }

    public function getEmail() 
    {
        return $this->email;
    }

    public function setEmail($email) 
    {
        $this->email = $email;
    }

    public function getCreateDate() 
    {
        return $this->createDate;
    }

    public function setCreateDate($createDate) 
    {
        $this->createDate = $createDate;
    }

    public function getUserImage() 
    {
        return $this->image_path;
    }

    public function setUserImage($image_path) 
    {
        $this->image_path = $image_path;
    }

    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    public function setAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }
}
?>
