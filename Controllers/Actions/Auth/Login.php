<?php

if (GET) show();
else JSON(405, 405);

function show()
{
    LoadView("Pages/Auth/Login");
}

// TODO: Login Request