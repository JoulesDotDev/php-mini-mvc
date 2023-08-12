<?php

function csrf()
{
    Component("FormShared/CsrfToken");
}

function action($action)
{
    Component("FormShared/Action", $action);
}
