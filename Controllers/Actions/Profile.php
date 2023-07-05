<?php

if (GET) show();
else JSON(404, 404);

function show()
{
    $user = _CONTEXT("user");
    View("Profile", $user);
}
