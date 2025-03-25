<?php
namespace src\models;

class EmailMessage {

    // Attributes
    private $emailMessageId;
    private $title;
    private $content;
    private $createDate;
    private $userId;

    public function __construct(
        $emailMessageId = null, 
        $title = null,
        $content = null,
        $createDate = null,
        $userId = null,
    ) {
        $this->$emailMessageId = $emailMessageId;
        $this->$title = $title;
        $this->$content = $content;
        $this->$createDate = $createDate;
        $this->$userId = $userId;
    }

    // Getters and Setters
    public function getEmailMessageId ()
    {
        return $this->emailMessageId;
    }

    public function setEmailMessageId ($emailMessageId)
    {
        $this->emailMessageId = $emailMessageId;
    }

    public function getTitle ()
    {
        return $this->title;
    }

    public function setTitle ($title)
    {
        $this->title = $title;
    }

    public function getContent ()
    {
        return $this->content;
    }

    public function setContent ($content)
    {
        $this->content = $content;
    }

    public function getUserId ()
    {
        return $this->userId;
    }

    public function setUserId ($userId)
    {
        $this->userId = $userId;
    }

    public function getCreateDate ()
    {
        return $this->createDate;
    }

    public function setCreateDate ($createDate)
    
        $this->createDate = $createDate;
    }
}
?>