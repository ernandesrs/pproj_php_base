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

define("CONF_MAIL_HOST", $env["MAIL_HOST"]);
define("CONF_MAIL_USERNAME", $env["MAIL_USERNAME"]);
define("CONF_MAIL_PASSWORD", $env["MAIL_PASSWORD"]);
define("CONF_MAIL_SMTP_AUTH", $env["MAIL_SMTP_AUTH"]);
define("CONF_MAIL_ENCRYPTION", $env["MAIL_ENCRYPTION"]);
define("CONF_MAIL_PORT", $env["MAIL_PORT"]);
define("CONF_MAIL_FROM_NAME", $env["MAIL_FROM_NAME"]);
define("CONF_MAIL_FROM_ADDRESS", $env["MAIL_FROM_ADDRESS"]);
define("CONF_MAIL_SMTP_OPTIONS", [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);

define("CONF_VIEWS_DIR", "/resources/views");
define("CONF_UPLOADS_DIR", "/storage/uploads");
define("CONF_CACHE_DIR", "/storage/cache");
define("CONF_LOGS_DIR", "/storage/logs");
