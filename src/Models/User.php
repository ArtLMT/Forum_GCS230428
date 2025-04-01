<?php
namespace src\models;


class User {
    private $pdo;
    private $userId;
    private $username;
    private $password;
    private $email;
    private $timestamp;
    private $image_path;
    
    public function __construct(
        $username,  // Required
        $password,  // Required
        $email,  // Required
        $userId = null, 
        $timestamp = null,
        $image_path = null
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->userId = $userId;
        $this->email = $email;
        $this->timestamp = $timestamp;
        $this->image_path = $image_path;
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

    public function getTimeStamp() 
    {
        return $this->timestamp;
    }

    public function setTimeStamp($timestamp) 
    {
        $this->timestamp = $timestamp;
    }

    public function getUserImage() 
    {
        return $this->image_path;
    }

    public function setUserImage($image_path) 
    {
        $this->image_path = $image_path;
    }
}
?>
