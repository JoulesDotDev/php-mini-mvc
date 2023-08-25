<?php

function redirect($location, $code = 302)
{
    header("Location: $location", true, $code);
    exit;
}

function hxRedirect($location)
{
    header("HX-Location: $location", true);
    header("HX-Retarget: body");
    exit;
}
