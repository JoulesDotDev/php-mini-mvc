<?php

function _GET($key)
{
    return isset($_GET[$key]) ? $_GET[$key] : null;
}

function _POST($key)
{
    return isset($_POST[$key]) ? $_POST[$key] : null;
}
