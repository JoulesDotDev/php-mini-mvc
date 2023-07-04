<?php

if (GET) show();
else JSON(405, 405);

function show()
{
    View("Home");
}
