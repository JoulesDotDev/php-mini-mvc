<?php

require_once ROOT_DIR . "/Models/DB.php";

class Validation
{
    private Validator $validator;
    private $value;
    private $field_name;
    private $errors = [];

    public function __construct($validator, $values, $field_name)
    {
        $this->validator = $validator;
        $this->value = $values[$field_name];
        $this->field_name = $field_name;
    }

    public function required()
    {
        if (!isset($this->value) || $this->value === "" || $this->value === null) {
            $this->errors[] = "This field is required";
        }
        return $this;
    }

    public function minLen($min)
    {
        if (strlen($this->value) < $min) {
            $this->errors[] = "This field must be at least $min characters long";
        }
        return $this;
    }

    public function maxLen($max)
    {
        if (strlen($this->value) > $max) {
            $this->errors[] = "This field must be at most $max characters long";
        }
        return $this;
    }

    public function id($table, $message)
    {
        return $this->required()
            ->integer()
            ->exists($table, "id", $message);
    }

    public function integer()
    {
        if (filter_var($this->value, FILTER_VALIDATE_INT) === false && !preg_match('/[eE]/', $this->value)) {
            $this->errors[] = "This field must be an integer";
        }
        return $this;
    }

    public function decimal()
    {
        if (filter_var($this->value, FILTER_VALIDATE_FLOAT) === false && !preg_match('/[eE]/', $this->value)) {
            $this->errors[] = "This field must be a decimal number";
        }
        return $this;
    }

    public function min($val)
    {
        if ($this->value < $val) {
            $this->errors[] = "This field must be at least $val";
        }
        return $this;
    }

    public function max($val)
    {
        if ($this->value > $val) {
            $this->errors[] = "This field must be at most $val";
        }
        return $this;
    }

    public function email()
    {
        return $this->required()
            ->emailPattern()
            ->maxLen(255);
    }

    public function emailPattern()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "This field must be a valid email address";
        }

        return $this;
    }

    public function name()
    {
        if (!preg_match('/^[\p{L} ]*$/u', $this->value)) {
            $this->errors[] = "This field must be a valid name";
        }
        return $this;
    }

    public function regex($pattern, $message)
    {
        if (!preg_match($pattern, $this->value)) {
            $this->errors[] = $message;
        }
        return $this;
    }

    public function image()
    {
        $imageInfo = getimagesize($this->value);
        $error = "The file is not a valid PNG or JPEG";

        if ($imageInfo === false) {
            $this->errors[] = $error;
        }

        if (!in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
            $this->errors[] = $error;
        }

        return $this;
    }

    public function maxSize($size)
    {
        if ($_FILES[$this->field_name]["size"] > $size) {
            $this->errors[] = "The file is too large";
        }
        return $this;
    }

    public function equals($other_value, $name)
    {
        if ($this->value !== $other_value) {
            $this->errors[] = "This field must be equal to $name";
        }
        return $this;
    }

    public function countRows($table, $column)
    {
        try {
            $stmt = DB::query("SELECT * FROM $table WHERE $column = ?", [$this->value]);
            $result = $stmt->fetchAll();
            return count($result);
        } catch (PDOException $e) {
            throw new DBException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function exists($table, $column, $message)
    {
        $result = $this->countRows($table, $column);
        if ($result < 1) {
            $this->errors[] = $message;
        }
        return $this;
    }

    public function unique($table, $column, $message)
    {
        $result = $this->countRows($table, $column);
        if ($result > 0) {
            $this->errors[] = $message;
        }
        return $this;
    }

    public function password()
    {
        return $this->required()
            ->minLen(8)
            ->maxLen(255);
    }

    public function done()
    {
        if (count($this->errors) > 0) {
            $this->validator->errors[$this->field_name] = $this->errors[0];
        }
    }
}
