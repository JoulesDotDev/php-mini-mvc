<?php

function _CONTEXT($key)
{
    return $GLOBALS["CONTEXT"][$key] ?? null;
}

function _CONTEXT_SET($key, $value)
{
    $GLOBALS["CONTEXT"][$key] = $value;
}
