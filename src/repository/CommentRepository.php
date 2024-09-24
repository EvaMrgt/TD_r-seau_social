<?php

abstract class CommentRepository extends Db
{
    public static function request($request, $params = [])
    {
        $db = self::getInstance();
        $stmt = $db->prepare($request);
        $stmt->execute($params);
        self::disconnect();
        return $stmt;
    }

    public static function addComment($post_id, $user_id, $content)
    {
        $query = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
        $params = [':post_id' => $post_id, ':user_id' => $user_id, ':content' => $content];
        $result = self::request($query, $params);
        return $result->rowCount() > 0 ? self::getInstance()->lastInsertId() : false;
    }

    public static function updateComment($commentId, $content)
    {
        $query = "UPDATE comments SET content = :content, modified = CURRENT_TIMESTAMP WHERE id = :commentId";
        $params = [':content' => $content, ':commentId' => $commentId];
        $result = self::request($query, $params);
        return $result->rowCount() > 0;
    }

    public static function softDeleteComment($commentId)
    {
        $query = "UPDATE comments SET deleted = 1 WHERE id = :commentId";
        $params = [':commentId' => $commentId];
        $result = self::request($query, $params);
        return $result->rowCount() > 0;
    }

    public static function isUserAuthor($commentId, $user_id)
    {
        $query = "SELECT user_id FROM comments WHERE id = :commentId";
        $params = [':commentId' => $commentId];
        $result = self::request($query, $params);
        $comment = $result->fetch(PDO::FETCH_ASSOC);
        return $comment && $comment['user_id'] == $user_id;
    }

    public static function getComments($post_id)
    {
        $db = self::getInstance();
        $query = "SELECT * FROM comments WHERE post_id = :post_id ORDER BY created_at DESC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        self::disconnect();
        return $comments;
    }

    public static function getCommentsBypostId($post_id)
    {
        $query = "SELECT * FROM comments WHERE post_id = :post_id AND deleted = 0 ORDER BY created_at DESC";
        $params = [':post_id' => $post_id];
        $result = self::request($query, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}