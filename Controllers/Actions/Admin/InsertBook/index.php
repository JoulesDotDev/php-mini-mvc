<?php

_CONTEXT_SET("head", ["title" => "Save Book"]);

if (GET) show();
if (POST) actions();

function show()
{
    View();
}

function actions()
{
    if (ACTION === "admin:insert-book") insertBook();
    else JSON(404, 404);
}

function insertBook()
{
}
