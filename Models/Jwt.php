<?php

require_once "DatabaseModel.php";

class JwtModel extends DatabaseModel
{
    public $jwt;
    public $expires;

    public static function table()
    {
        return "jwt";
    }

    public static function checkIfBlackListed($jwt)
    {
        try {
            $stmt = DB::query("SELECT * FROM " . self::table() . " WHERE jwt = ?", [$jwt]);
            $result = $stmt->fetch();
            if (!$result) return false;
            return true;
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function blacklist($jwt)
    {
        try {
            $data = JWT::decode($jwt);
            if (!$data) return;
            $expires = $data[0]->exp;

            $result = DB::query("INSERT INTO " . self::table() . " (jwt, expires) VALUES (?, ?)", [$jwt, $expires]);
            if (!$result) throw new DBException("Failed to blacklist JWT");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function delistExpired()
    {
        try {
            $result = DB::query("DELETE FROM " . self::table() . " WHERE expires < ?", [time()]);
            if (!$result) throw new DBException("Failed to delist expired JWTs");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
