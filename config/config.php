<?php

$env = parse_ini_file(__DIR__ . '/../.env', true);

if (!$env) {
    die("Error: Unable to load environment file.");
}

define('DB_HOST', $env['DB_HOST']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USERNAME', $env['DB_USERNAME']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
