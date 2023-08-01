<?php

class Cookie
{
    public static function set($name, $value, $expiry = SESSION_TIMEOUT)
    {
        setcookie(
            $name,
            $value,
            [
                "expires" => time() + $expiry,
                "secure" => PRODUCTION,
                "httponly" => true,
                "samesite" => "Lax"
            ]
        );
    }

    public static function delete($name)
    {
        self::set($name, '', time() - 1);
    }

    public static function get($name)
    {
        return $_COOKIE[$name] ?? null;
    }

    public static function exists($name)
    {
        return isset($_COOKIE[$name]);
    }
}
