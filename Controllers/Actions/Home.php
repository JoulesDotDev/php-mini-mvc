<?php

_CONTEXT_SET("_head", ["title" => "Home"]);

if (GET) show();

function show()
{
    View("Home");
}
