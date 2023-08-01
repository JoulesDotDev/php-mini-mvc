<?php

class DBException extends Exception
{
    public function __construct($message = "Database error", $code = 500, $previous = null)
    {
        $code = is_string($code) ? 500 : $code; // Because of SQLSTATE errors
        parent::__construct($message, $code, $previous);
    }
}
