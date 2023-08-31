<?php

trait UserAuth
{
    public static function login($email, $password)
    {
        try {
            $stmt = DB::query("SELECT * FROM " . self::table() . " WHERE email = ?", [$email]);
            $result = $stmt->fetch();
            if (!$result) return false;

            if (!VerifyPassword($password, $result["password"])) return false;
            if (!$result["verified"]) return true;

            $jwt = JWT::encode(["id" => $result["id"]]);
            Cookie::set("token", $jwt);
            if ($result["admin"]) redirect("/admin");
            else redirect("/");
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
            $user = User::getById($payload->id, true);
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
}
