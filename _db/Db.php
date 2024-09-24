<?php
class Db
{
    private static $instance;
    private $pdo;

    protected static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=localhost;dbname=projet", "root", "");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function getConnection()
    {
        return self::getInstance();
    }

    public function getConnected()
    {
        return $this->pdo;
    }

    protected static function disconnect()
    {
        self::$instance = null;
    }
}
