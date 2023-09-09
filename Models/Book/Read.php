<?php

require_once ROOT_DIR . "/Models/Traits/Read.php";

trait BookRead
{
    use ModelRead;

    public static function getByIsbn($isbn)
    {
        $stmt = DB::query("SELECT * FROM " . self::table() . "  WHERE isbn = ?", [$isbn]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) return null;
        return $result;
    }
}
