<?php

abstract class PostRepository extends Db
{

    public static function request($request)
    {
        $result = self::getInstance()->query($request);
        self::disconnect();
        return $result;
    }

    public static function createPost($title, $content, $userId)
    {
        return self::request("INSERT INTO posts (user_id, title, content) VALUES ('$userId', '$title', '$content')")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPost()
    {
        return self::request("SELECT * FROM posts")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deletePost($id)
    {
        return self::request("DELETE FROM posts WHERE id = '$id' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function editPost($id, $title, $content){
        $db = self::getInstance();
        $query = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $result = $stmt->execute();
        self::disconnect();
        return $result;
    }
}
