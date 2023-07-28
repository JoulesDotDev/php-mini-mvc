<?php

Routing::globalMiddleware([
    "Logging"
]);

Routing::routes([
    "" => "Home",
    "logout" => "Auth/Logout",
    "500" => "Error/500"
]);

Routing::routes([
    "login" => "Auth/Login",
    "register" => "Auth/Register"
])->middleware(["NoAuth"]);

Routing::routes(["profile" => "Profile"])->middleware(["Auth"]);
