<?php

require_once ROOT_DIR . "/Models/DB.php";
require_once "Read.php";

class Author
{
    use AuthorRead;

    public $id;
    public $name;

    public static function table()
    {
        return "authors";
    }

    public function fill($values)
    {
        $this->id = $values["id"] ?? null;
        $this->name = $values["name"];
    }

    public function save()
    {
        try {
            $result = DB::query(
                "INSERT INTO " . self::table() .
                    " (id, name)" .
                    " VALUES (?, ?)" .
                    " ON DUPLICATE KEY UPDATE" .
                    " id = VALUES(id), name = VALUES(name)",
                [$this->id, $this->name]
            );

            if (!$result) throw new DBException("Failed to save Author");

            return self::_getById(DB::lastInsertId());
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
