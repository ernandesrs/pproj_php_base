<?php

namespace App\Controllers;

use App\Core\Controller;
use CoffeeCode\Router\Router;

class AdminController extends Controller
{
    public function __construct(Router $router)
    {
        $auth = logged();
        if (!$auth) {
            header("Location: " . $router->route("front.index"));
            return;
        }

        if (!in_array($auth->level, [2, 3])) {
            header("Location: " . $router->route("front.index"));
            return;
        }

        parent::__construct($router);
    }
}
