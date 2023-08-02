<?php

function Component($path, $data = null)
{
    require ROOT_DIR . "/Views/Components/$path.php";
}

function ComponentOnce($path, $data = null)
{
    require_once ROOT_DIR . "/Views/Components/$path.php";
}

function View($path, $data = null)
{
    require_once ROOT_DIR . "/Views/Pages/$path.php";
}

function Layout($path, $data = null)
{
    require_once ROOT_DIR . "/Views/Layouts/$path.php";
}
