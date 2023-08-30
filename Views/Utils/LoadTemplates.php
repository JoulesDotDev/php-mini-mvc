<?php

function Component($path, $data = null, $page = null)
{
    if (!$page) $page = _CONTEXT("_page");
    $component = ROOT_DIR . "/Views/Pages/$page/Components/$path.php";
    Log::Simple($component);

    if (!is_file($component) || $path[0] === "/") {
        if ($path[0] === "/") $path = substr($path, 1);
        $component = ROOT_DIR . "/Views/Components/$path.php";
    }

    require $component;
}

function View($path = null)
{
    if (!$path) $path = _CONTEXT("_controller");
    _CONTEXT_SET("_page", $path);

    $page = ROOT_DIR . "/Views/Pages/$path";
    if (is_dir($page)) {
        $page .= "/index.php";
    } else {
        $page .= ".php";
    }

    Component("/Layout/BaseHeader");
    require_once $page;
    Component("/Layout/BaseFooter");
}
