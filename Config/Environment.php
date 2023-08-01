<?php

define('BASE_URL', "localhost");
define('PRODUCTION', false);
define('CRON', !isset($_SERVER['REQUEST_METHOD']));
