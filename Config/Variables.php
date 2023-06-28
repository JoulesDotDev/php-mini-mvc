<?php

define('ROOT_DIR', dirname(__FILE__) . '/../');

define('METHOD', $_SERVER['REQUEST_METHOD']);

define('ACTION', isset($_POST['action']) ? $_POST['action'] : null);
