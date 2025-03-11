<?php
class User {
    private $pdo;
    private $userId;
    private $username;
    private $password;
    private $email;
    private $timestamp;
    private $updatedTimestamp;
    
    public function __construct($userId, $username, $password, $email, $timestamp, $updatedTimestamp) 
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->timestamp = $timestamp;
        $this->updatedTimestamp = $updatedTimestamp;
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

    public function getUpdatedTimeStamp() 
    {
        return $this->updatedTimestamp;
    }
}
?>
