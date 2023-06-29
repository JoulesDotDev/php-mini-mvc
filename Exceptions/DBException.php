<?php

class DBException extends Exception
{
    public function __construct($message = "Database error", $code = 500, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
