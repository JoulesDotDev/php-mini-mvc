<?php

function csrf()
{
    Component("Form/CsrfToken");
}

function action($action)
{
    Component("Form/Action", $action);
}
