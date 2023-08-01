<?php

class EmailException extends Exception
{
    public function __construct($message = "Mail error", $code = 500, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
