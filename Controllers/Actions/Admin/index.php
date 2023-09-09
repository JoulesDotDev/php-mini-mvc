<?php

_CONTEXT_SET("_head", ["title" => "Admin"]);

if (GET) show();

function show()
{
    $option = _GET("manage");
    if (HTMX) {
        if ($option === "books") return Component("BookOptions");
        if ($option === "cards") return Component("CardOptions");
    }
    View();
}
