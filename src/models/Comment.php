<?php

class Comment extends CommentRepository {
    private $id;
    private $post_id;
    private $user_id;
    private $content;
    private $created_at;
    private $modified;
    private $deleted;

    public function __construct($id, $post_id, $user_id, $content, $created_at, $modified = 0, $deleted = 0)
    {
        $this->id = $id;
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->modified = $modified;
        $this->deleted = $deleted;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getpostId()
    {
        return $this->post_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function isModified()
    {
        return $this->modified;
    }

    public function isDeleted()
    {
        return $this->deleted;
    }

    public static function createFromArray($data)
    {
        return new self(
            $data['id'],
            $data['post_id'],
            $data['user_id'],
            $data['content'],
            $data['created_at'],
            $data['modified'],
            $data['deleted']
        );
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'modified' => $this->modified,
            'deleted' => $this->deleted
        ];
    }
}