<?php

class Post extends PostRepository
{
    private $id;
    private $title;
    private $content;
    private $userId;

    public function __construct($id, $title, $content, $userId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function getUserID()
    {
        return $this->userId;
    }

    public function setUserID($userId)
    {
        $this->userId = $userId;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
}
