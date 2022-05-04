<?php

require_once __DIR__ . "/vendor/autoload.php";

$router = (new \CoffeeCode\Router\Router(CONF_APP_URL, "@"));

/**
 * FRONT CONTROLLERS
 */
$router->namespace("\\App\\Controllers\\Front");
$router->group("/");
$router->get("/", "IndexController@index", "front.index");
$router->get("/sobre", "IndexController@about", "front.about");
$router->get("/teste", "TestController@index", "front.test");

// auth
$router->get("/login", "AuthController@login", "auth.login");
$router->post("/authenticate", "AuthController@authenticate", "auth.authenticate");
$router->get("/register", "AuthController@register", "auth.register");
$router->post("/create", "AuthController@create", "auth.create");

/**
 * ADMIN CONTROLLERS
 */
$router->namespace("\\App\\Controllers\\Admin");
$router->group("/admin");
$router->get("/", "IndexController@index", "admin.index");

/**
 * API CONTROLLERS
 */
$router->namespace("\\App\\Controllers\\Api");
$router->group("/api");
$router->get("/", "IndexController@index", "api.index");

$router->dispatch();

if ($errCode = $router->error()) {
    echo "erro {$errCode}";
}
