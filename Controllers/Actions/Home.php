<?php

_CONTEXT_SET("page", ["title" => "Home"]);

if (GET) show();

function show()
{
    View("Home");
}
