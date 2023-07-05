<?php

define('URI', $_SERVER['REQUEST_URI']);
define('GET', $_SERVER['REQUEST_METHOD'] === "GET");
define('POST', $_SERVER['REQUEST_METHOD'] === "POST");
define('METHOD', $_SERVER['REQUEST_METHOD']);

define('ACTION', isset($_POST['action']) ? $_POST['action'] : null);
