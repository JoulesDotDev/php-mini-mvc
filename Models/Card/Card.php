<?php

require_once ROOT_DIR . "/Models/DB.php";

class BooksUsers
{
    public $id;
    public $user_id;
    public $number;
    public $paid_at;

    public static function table()
    {
        return "cards";
    }

    public function fill($values)
    {
        $this->id = $values["id"] ?? null;
        $this->user_id = $values["user_id"];
        $this->number = $values["number"];
        $this->paid_at = $values["paid_at"];
    }

    public function save()
    {
        try {
            $result = DB::query(
                "INSERT INTO " . self::table() .
                    " (id, user_id, number, paid_at)" .
                    " VALUES (?, ?, ?, ?)" .
                    " ON DUPLICATE KEY UPDATE" .
                    " id = VALUES(id), user_id = VALUES(user_id), number = VALUES(number)," .
                    " paid_at = VALUES(paid_at)",
                [$this->id, $this->user_id, $this->number, $this->paid_at]
            );

            if (!$result) throw new DBException("Failed to save book as borrowed");
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
