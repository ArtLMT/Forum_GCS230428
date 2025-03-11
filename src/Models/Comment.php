<?php
// require_once __DIR__ . "/Database.php";

class Comment {
    private $pdo;
    private $commentId;
    private $content;
    private $voteScore;
    private $userId;
    private $postId;
    private $timestamp;
    private $updatedTimestamp;

    public function __construct($commentId, $content, $voteScore, $userId, $postId, $timestamp, $updatedTimestamp) 
    {
        $this->commentId = $commentId;
        $this->content = $content;
        $this->voteScore = $voteScore;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->timestamp = $timestamp;
        $this->updatedTimestamp = $updatedTimestamp;
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

    public function getVoteScore() 
    {
        return $this->voteScore;
    }

    public function setVoteScore($voteScore) 
    {
        $this->voteScore = $voteScore;
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

    public function setUpdatedTimeStamp($updatedTimestamp) 
    {
        $this->updatedTimestamp = $updatedTimestamp;
    }
?>
