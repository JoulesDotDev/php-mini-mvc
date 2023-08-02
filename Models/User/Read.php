<?php

trait UserRead
{
    public static function getById($id, $secretMode = false)
    {
        try {
            $stmt = DB::query("SELECT * FROM " . self::table() . "  WHERE id = ?", [$id]);
            $result = $stmt->fetch();
            if (!$result) return null;

            $user = new User();
            $user->id = $id;
            $user->fill($result, $secretMode);

            if ($secretMode) return $user->filteredData();
            return $user;
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function getByEmail($email)
    {
        try {
            $stmt = DB::query("SELECT * FROM " . self::table() . " WHERE email = ?", [$email]);
            $result = $stmt->fetch();
            if (!$result) return null;

            $user = new User();
            $user->id = $result["id"];
            $user->fill($result, true);

            return $user;
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
