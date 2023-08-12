<?php

function _FLASH($key, $subkey = null)
{
    if ($subkey)
        return $_SESSION["FLASH"][$key][$subkey] ?? null;
    else
        return $_SESSION["FLASH"][$key] ?? null;
}

function _FLASH_SET($key, $value)
{
    $_SESSION["FLASH"][$key] = $value;
}
