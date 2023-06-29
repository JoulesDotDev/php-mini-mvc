<?php

function redirect($location, $code = 302)
{
    header("Location: $location", true, $code);
    exit;
}
