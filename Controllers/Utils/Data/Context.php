<?php

function _CONTEXT($key, $subkey = null)
{
    if ($subkey)
        return $GLOBALS["CONTEXT"][$key][$subkey] ?? null;
    else
        return $GLOBALS["CONTEXT"][$key] ?? null;
}

function _CONTEXT_SET($key, $value)
{
    $GLOBALS["CONTEXT"][$key] = $value;
}
