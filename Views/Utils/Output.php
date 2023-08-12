<?php

function __($text)
{
    return htmlentities($text, ENT_QUOTES, 'UTF-8');
}
