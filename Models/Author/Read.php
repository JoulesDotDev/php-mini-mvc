<?php

require_once ROOT_DIR . "/Models/Traits/Read.php";

trait AuthorRead
{
    use ModelRead;

    public static function search($search)
    {
        $search = trim($search);
        if (!$search) return [];

        $stmt = DB::query("SELECT * FROM " . self::table() . "  WHERE name LIKE ?", ["%$search%"]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!$result) return [];
        return $result;
    }
}
