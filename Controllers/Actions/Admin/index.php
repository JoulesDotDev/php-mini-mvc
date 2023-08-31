<?php

_CONTEXT_SET("page", ["title" => "Admin"]);

if (GET) show();

function show()
{
    $option = _GET("manage");
    if (_CONTEXT("_ajax")) {
        if ($option === "books") return Component("BookOptions");
        if ($option === "cards") return Component("CardOptions");
    }
    View();
}
