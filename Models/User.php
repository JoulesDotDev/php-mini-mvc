<?php

require_once "DatabaseModel.php";
require_once "Jwt.php";

class User extends DatabaseModel
{
    public $id;
    public $email;
    public $password;

    public static function table()
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

    public function fill($values)
    {
        $this->email = $values["email"];
        $this->password = isset($values["password"]) ? HashPassword($values["password"]) : null;
    }

    public static function login($email, $password)
    {
        try {
            $stmt = DB::query("SELECT * FROM users WHERE email = ?", [$email]);
            $result = $stmt->fetch();
            if (!$result) return null;
            if (!VerifyPassword($password, $result["password"])) return null;

            $jwt = JWT::encode(["id" => $result["id"]]);
            Cookie::set("token", $jwt);
            redirect("/");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function getCurrentUser()
    {
        $jwt = Cookie::get("token");
        $data = JWT::decode($jwt);
        if (!$data) return null;

        $result = JwtModel::checkIfBlackListed($jwt);
        if ($result) return null;

        $payload = $data[1];

        try {
            $user = User::getById($payload->id);
            if (!$user) return null;
            return $user;
        } catch (DBException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function logout()
    {
        $jwt = Cookie::get("token");
        $data = JWT::decode($jwt);
        if ($data) {
            JwtModel::blacklist($jwt);
            Cookie::delete("token");
        }
        redirect("/login");
    }

    public static function getById($id)
    {
        try {
            $stmt = DB::query("SELECT id, email FROM users WHERE id = ?", [$id]);
            $result = $stmt->fetch();
            if (!$result) return null;

            $user = new User();
            $user->id = $id;
            $user->fill($result);

            return $user;
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
