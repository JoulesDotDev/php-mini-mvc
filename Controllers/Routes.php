<?php

Routing::globalMiddleware([
    "Logging",
    "Csrf"
]);

Routing::routes([
    "" => "Home",
    "logout" => "Auth/Logout",
    "500" => "Error/500"
]);

Routing::routes([
    "login" => "Auth/Login",
    "register" => "Auth/Register",
    "verify-email" => "Auth/VerifyEmail",
    "verify-resend" => "Auth/VerifyResend"
])->middleware(["NoAuth"]);

Routing::routes(["profile" => "Profile"])->middleware(["Auth"]);
