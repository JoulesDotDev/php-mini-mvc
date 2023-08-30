<?php

function navbarLinks()
{
    $links = [
        "Books" => "/"
    ];

    if (_CONTEXT("user")) {
        $links["Profile"] = "/profile";
    } else {
        $links["Login"] = "/login";
        $links["Register"] = "/register";
    }
    if (_CONTEXT("user", "admin")) $links["Admin"] = "/admin";

    return $links;
}
