<?php

function navbarLinks()
{
    $links = [
        "Books" => "/"
    ];

    if (_CONTEXT("user")) $links["Profile"] = "/profile";
    if (_CONTEXT("user", "admin")) $links["Admin"] = "/admin";

    return $links;
}
