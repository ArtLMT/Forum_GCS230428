<?php
namespace src\models;

class Post {

    // Attributes
    private $postId;
    private $title;
    private $content;
    private $voteScore;
    private $userId;
    private $moduleId;
    private $timestamp;
    private $updatedTimestamp;
    private $image;

    // Constructor (updated with default values so it can be created without all parameters)
    public function __construct(
        $postId = null,
        $title = null,
        $content = null,
        $voteScore = 0,
        $userId = null,
        $moduleId = null,
        $timestamp = null,
        $updatedTimestamp = null,
        $image = null
    ) {
        $this->postId = $postId;
        $this->title = $title;
        $this->content = $content;
        $this->voteScore = $voteScore;
        $this->userId = $userId;
        $this->moduleId = $moduleId;
        $this->timestamp = $timestamp;
        $this->updatedTimestamp = $updatedTimestamp;
        $this->image = $image;
    }

    // Getters and Setters

    public function getPostId() {
        return $this->postId;
    }

    public function setPostId($postId) {
        $this->postId = $postId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getVoteScore() {
        return $this->voteScore;
    }

    public function setVoteScore($voteScore) {
        $this->voteScore = $voteScore;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getModuleId() {
        return $this->moduleId;
    }

    public function setModuleId($moduleId) {
        $this->moduleId = $moduleId;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function getUpdatedTimestamp() {
        return $this->updatedTimestamp;
    }

    public function setUpdatedTimestamp($updatedTimestamp) {
        $this->updatedTimestamp = $updatedTimestamp;
    }

    // New getter for the image
    public function getPostImage() {
        return $this->image;
    }

    // New setter for the image
    public function setImage($image) {
        $this->image = $image;
    }

}
?>
