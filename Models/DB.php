<?php

class DB
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DB();
        }

        return self::$instance;
    }

    public static function query($sql, $params = [])
    {
        $stmt = self::getInstance()->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function lastInsertId()
    {
        return self::getInstance()->conn->lastInsertId();
    }
}
