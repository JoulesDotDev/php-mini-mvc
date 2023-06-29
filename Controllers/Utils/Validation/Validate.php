<?php

require ROOT_DIR . "/Models/DB.php";

class Validate
{
    public static function required($value)
    {
        if ($value === "" || $value === null || !isset($value)) {
            return "This field is required";
        }
        return null;
    }

    public static function minLen($value, $min)
    {
        if (strlen($value) < $min) {
            return "This field must be at least $min characters long";
        }
        return null;
    }

    public static function maxLen($value, $max)
    {
        if (strlen($value) > $max) {
            return "This field must be at most $max characters long";
        }
        return null;
    }

    public static function email($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "This field must be a valid email address";
        }
        return null;
    }

    public static function regex($value, $pattern, $message)
    {
        if (!preg_match($pattern, $value)) {
            return $message;
        }
        return null;
    }

    public static function equals($value, $other_value, $name)
    {
        if ($value !== $other_value) {
            return "This field must be equal to $name";
        }
        return null;
    }

    public static function unique($value, $table, $column, $message)
    {
        $stmt = DB::query("SELECT * FROM $table WHERE $column = ?", [$value]);
        $result = $stmt->fetchAll();
        if (count($result) > 1) {
            return $message;
        }
        return null;
    }
}
