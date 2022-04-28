<?php

namespace App\Controllers;

use App\Core\Controller;
use CoffeeCode\Router\Router;

class FrontController extends Controller
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }
}