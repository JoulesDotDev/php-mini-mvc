<?php

_CONTEXT_SET("page", ["title" => "Profile"]);

if (GET) show();
else JSON(404, 404);

function show()
{
    $user = _CONTEXT("user");
    _CONTEXT_SET("user", $user);
    View("Profile");
}
