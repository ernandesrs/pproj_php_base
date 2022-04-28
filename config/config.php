<?php

$env = parse_ini_file(__DIR__ . "/../.env");

session_start();
date_default_timezone_set($env["APP_TIMEZONE"]);

/**
 * Data Layout PHP Componnet Setting
 */
define("DATA_LAYER_CONFIG", [
    "driver" => $env["DATABASE_DRIVER"],
    "host" => $env["DATABASE_HOST"],
    "port" => $env["DATABASE_PORT"],
    "dbname" => $env["DATABASE_DBNAME"],
    "username" => $env["DATABASE_USERNAME"],
    "passwd" => $env["DATABASE_PASSWORD"],
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define("CONF_BASE_PATH", __DIR__ . "/..");
define("CONF_APP_NAME", $env["APP_NAME"]);
define("CONF_APP_URL", $env["APP_URL"]);
define("CONF_APP_LOCAL", $env["APP_LOCAL"]);

define("CONF_VIEWS_DIR", $env["APP_VIEWS_DIR"]);
define("CONF_UPLOADS_DIR", $env["APP_UPLOADS_DIR"]);