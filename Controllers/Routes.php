<?php

function routes()
{
    return array(
        "" => "Home",
        "register" => "Auth/Register",
        "login" => "Auth/Login",
    );
}
