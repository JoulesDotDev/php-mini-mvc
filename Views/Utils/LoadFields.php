<?php

function csrf()
{
    Component("Fields/CsrfToken");
}

function action($action)
{
    Component("Fields/Action", $action);
}
