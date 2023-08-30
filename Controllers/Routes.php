<?php

Routing::globalMiddleware([
    "Logging",
    "Csrf",
    "User"
]);

Routing::routes([
    "" => "Home",
    "logout" => "Auth/Logout",
    "404" => "Error/404",
    "500" => "Error/500"
]);

Routing::routes([
    "login" => "Auth/Login",
    "register" => "Auth/Register",
    "verify-email" => "Auth/VerifyEmail",
    "verify-resend" => "Auth/VerifyResend",
    "reset-password" => "Auth/ResetPassword"
])->middleware(["NoAuth"]);

Routing::routes(["profile" => "Profile"])->middleware(["Auth"]);
//Routing::routes(["admin" => "Admin"])->middleware(["Auth", "Admin"]);