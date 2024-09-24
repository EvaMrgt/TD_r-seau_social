<?php

abstract class UserRepository extends Db {
    public static function getUserByName($username){
        try {
            $db = Db::getInstance();
            $stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->execute(['username' => $username]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e){
            echo "Error fetching user : " . $e->getMessage();
            return null;
        }
    }

    public static function insert (User $user){
        try {
            $username = $user->getUsername();
            $password = $user->getUsername();
            $db = self::getInstance();
            $stmt = $db->prepare("INSERT INTO user (username, password) VALUES (:username, :password");
            return $stmt->execute(['username' => $username, 'password' => $password]);
        } catch (PDOException $e) {
            echo "Error inserting user : " . $e->getMessage();
            return false;
        }
    }
}