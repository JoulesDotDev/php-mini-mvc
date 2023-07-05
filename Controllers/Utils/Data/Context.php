<?php

function _CONTEXT($key)
{
    return isset($GLOBALS["CONTEXT"][$key]) ? $GLOBALS["CONTEXT"][$key] : null;
}

function _CONTEXT_SET($key, $value)
{
    $GLOBALS["CONTEXT"][$key] = $value;
}
