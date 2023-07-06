<?php

class Cookie
{
    public static function set($name, $value, $expiry = SESSION_TIMEOUT)
    {
        setcookie(
            name: $name,
            value: $value,
            expires: time() + $expiry,
            path: '/',
            secure: PRODUCTION,
            httpOnly: true
        );
    }

    public static function delete($name)
    {
        self::set($name, '', time() - 1);
    }

    public static function get($name)
    {
        return $_COOKIE[$name];
    }

    public static function exists($name)
    {
        return isset($_COOKIE[$name]);
    }
}
