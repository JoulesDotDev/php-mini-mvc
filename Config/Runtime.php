<?php

define('GET', $_SERVER['REQUEST_METHOD'] === "GET");
define('POST', $_SERVER['REQUEST_METHOD'] === "POST");

define('ACTION', isset($_POST['action']) ? $_POST['action'] : null);

//TODO Allowed-Methods Header
