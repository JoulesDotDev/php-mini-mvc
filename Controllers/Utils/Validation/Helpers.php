<?php

trait ValidationHelpers
{
    public function required($value)
    {
        if ($value === "") {
            return "This field is required";
        }
        return null;
    }

    public function minLen($value, $min)
    {
        if (strlen($value) < $min) {
            return "This field must be at least $min characters long";
        }
        return null;
    }

    public function maxLen($value, $max)
    {
        if (strlen($value) > $max) {
            return "This field must be at most $max characters long";
        }
        return null;
    }

    public function email($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "This field must be a valid email address";
        }
        return null;
    }

    public function regex($value, $pattern, $message)
    {
        if (!preg_match($pattern, $value)) {
            return $message;
        }
        return null;
    }

    public function equals($value, $other_value, $name)
    {
        if ($value !== $other_value) {
            return "This field must be equal to $name";
        }
        return null;
    }

    public function unique($value, $table, $column, $message)
    {
        $query = $this->db->prepare("SELECT * FROM $table WHERE $column = ?");
        $query->execute([$value]);
        $result = $query->fetch();
        if ($result) {
            return $message;
        }
        return null;
    }
}
