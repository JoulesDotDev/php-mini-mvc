<?php

require_once ROOT_DIR . "/Models/User/User.php";

$user =  _CONTEXT("user");
if ($user) redirect("/profile");
