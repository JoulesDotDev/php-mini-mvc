<?php

function Component($path, $data = null, $page = null)
{
    if (!$page) $page = _CONTEXT("__page");
    $component = ROOT_DIR . "/Views/Pages/$page/Components/$path.php";

    if (!is_file($component) || $path[0] === "/") {
        if ($path[0] === "/") $path = substr($path, 1);
        $component = ROOT_DIR . "/Views/Components/$path.php";
    }

    require $component;
}

function View($path = null)
{
    if (!$path) $path = _CONTEXT("__controller");
    _CONTEXT_SET("__page", $path);

    $page = ROOT_DIR . "/Views/Pages/$path";
    if (is_dir($page)) {
        $page .= "/index.php";
    } else {
        $page .= ".php";
    }

    Component(_CONTEXT("_layout", "header") ?? "/Layout/BaseHeader");
    require_once $page;
    Component(_CONTEXT("_layout", "footer") ?? "/Layout/BaseFooter");
}
