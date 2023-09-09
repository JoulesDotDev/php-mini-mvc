<?php

_CONTEXT_SET("head", ["title" => "Home"]);

if (GET) show();

function show()
{
    View("Home");
}
