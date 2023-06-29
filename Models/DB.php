<?php

class DB
{
    public static function connect()
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }

    public static function query($sql, $params = [])
    {
        $conn = self::connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
