<?php

Routing::globalMiddleware([
    "Logging"
]);

Routing::routes([
    "" => "Home",
    "register" => "Auth/Register",
    "login" => "Auth/Login",
]);

Routing::routes([
    "profile" => "Profile"
])->middleware([
    "Auth"
]);
