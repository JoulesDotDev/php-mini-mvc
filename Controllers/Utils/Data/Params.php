<?php

function _GET($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : null;
}

function _POST($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : null;
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
