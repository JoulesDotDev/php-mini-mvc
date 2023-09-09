<?php

trait ModelRead
{
    public static function _getById($id)
    {
        $stmt = DB::query("SELECT * FROM " . self::table() . "  WHERE id = ?", [$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) return null;
        return $result;
    }
}
