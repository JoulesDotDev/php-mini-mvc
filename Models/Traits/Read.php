<?php

trait ModelRead
{
    public static function _getById($id)
    {
        $stmt = DB::query("SELECT * FROM " . self::table() . "  WHERE id = ?", [$id]);
        $result = $stmt->fetch();
        if (!$result) return null;
        return $result;
    }
}
