<?php

require_once ROOT_DIR . "/Models/DB.php";
require_once ROOT_DIR . "/Models/Utils/Jwt.php";
require_once ROOT_DIR . "/Models/Traits/Filter.php";

require_once "Auth.php";
require_once "Read.php";

class User
{
    use UserAuth;
    use UserRead;
    use FilterTrait;

    public $id;
    public $email;
    public $name;
    public $password;
    public $verified;
    public $admin;

    public static function table()
    {
        return "users";
    }

    public static function secret()
    {
        return ["password"];
    }

    public function fill($values)
    {
        $this->id = $values["id"] ?? null;
        $this->email = $values["email"];
        $this->name = $values["name"];
        $this->password = $values["password"];
        $this->verified = $values["verified"];
        $this->admin = $values["admin"];
    }

    public function save()
    {
        try {
            $result = DB::query(
                "INSERT INTO " . self::table() .
                    " (id, email, name, password, verified)" .
                    " VALUES (?, ?, ?, ?, ?)" .
                    " ON DUPLICATE KEY UPDATE" .
                    " id = VALUES(id), email = VALUES(email), name = VALUES(name)," .
                    " password = VALUES(password), verified = VALUES(verified)",
                [$this->id, $this->email, $this->name, $this->password, $this->verified]
            );

            if (!$result) throw new DBException("Failed to save user");

            $this->id = DB::lastInsertId();
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
