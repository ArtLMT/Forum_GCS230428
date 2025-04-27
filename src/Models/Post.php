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
    private $postedTime;
    private $username;
    private $image;
    private $moduleName;
    private $avatar;

    // Constructor (updated with default values so it can be created without all parameters)
    public function __construct(
        $postId = null,
        $title = null,
        $content = null,
        $voteScore = 0,
        $userId = null,
        $moduleId = null,
        $postedTime = null,
        $username = null,
        $moduleName = null,
        $image = null,
        $avatar = null
    ) {
        $this->postId = $postId;
        $this->title = $title;
        $this->content = $content;
        $this->voteScore = $voteScore;
        $this->userId = $userId;
        $this->moduleId = $moduleId;
        $this->postedTime = $postedTime;
        $this->username = $username;
        $this->moduleName = $moduleName;
        $this->image = $image;
        $this->avatar = $avatar;
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

    public function getPostedTime() {
        return $this->postedTime;
    }

    public function setPostedTime($postedTime) {
        $this->postedTime = $postedTime;
    }

    public function getUserName() {
        return $this->username;
    }

    public function setUserName($username) {
        $this->username = $username;
    }

    // New getter for the image
    public function getPostImage() {
        return $this->image;
    }

    // New setter for the image
    public function setImage($image) {
        $this->image = $image;
    }

    public function getModuleName() {
        return $this->moduleName;
    }

    public function setModuleName($moduleName) {
        $this->moduleName = $moduleName;
    }

    public function getUserImage()
    {
        return $this->avatar;
    }

    public function setUserImage($avatar)
    {
        $this->avatar = $avartar;
    }
}
?>
