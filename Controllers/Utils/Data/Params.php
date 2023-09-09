<?php

function _GET($key)
{
    return $_GET[$key] ?? null;
}

function _POST($key)
{
    return $_POST[$key] ?? null;
}

function _FILES($key)
{
    return $_FILES[$key] ?? null;
}

function _FILEValues($keys)
{
    $values = [];
    foreach ($keys as $key) {
        $values[$key] = _FILES($key);
    }
    return $values;
}

function _POSTValues($keys)
{
    $values = [];
    foreach ($keys as $key) {
        $values[$key] = _POST($key);
    }
    return $values;
}

function _GETValues($keys)
{
    $values = [];
    foreach ($keys as $key) {
        $values[$key] = _GET($key);
    }
    return $values;
}
