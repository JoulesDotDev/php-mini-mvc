<?php

function LoadView($path, $data = [])
{
    extract($data);
    require_once ROOT_DIR . "/Views/$path.php";
}
