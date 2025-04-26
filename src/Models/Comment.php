<?php
namespace src\models;
// require_once __DIR__ . "/Database.php";

class Comment {
    private $commentId;
    private $content;
    private $userId;
    private $username;
    private $userImage;
    private $postId;
    private $commentDate;

    public function __construct(
        $commentId = null,
        $content = null, 
        $userId = null, 
        $username = null,
        $userImage = null, 
        $postId = null, 
        $commentDate = null) 
    {
        $this->commentId = $commentId;
        $this->content = $content;
        $this->userId = $userId;
        $this->username = $username;
        $this->userImage = $userImage;
        $this->postId = $postId;
        $this->commentDate = $commentDate;
    }

    public function getCommentId() 
    {
        return $this->commentId;
    }

    public function setCommentId($commentId) 
    {
        $this->commentId = $commentId;
    }

    public function getContent() 
    {
        return $this->content;
    }

    public function setContent($content) 
    {
        $this->content = $content;
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

    public function getUserImage()
    {
        return $this->userImage;
    }
    
    public function setUserImage($userImage)
    {
        $this->userImage = $userImage;
    }

    public function getCommentDate() 
    {
        return $this->timestamp;
    }

    public function setCommentDate($commentDate) 
    {
        $this->timestamp = $commentDate;
    }
}
?>
