<?php

require_once "DatabaseModel.php";

class UserModel extends DatabaseModel
{
    public $id;
    public $email;
    public $password;

    public static function getTableName()
    {
        return "users";
    }

    public function save()
    {
        try {
            $result = DB::query("INSERT INTO users (email, password) VALUES (?, ?)", [$this->email, $this->password]);
            if (!$result) throw new DBException("Failed to save user");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
