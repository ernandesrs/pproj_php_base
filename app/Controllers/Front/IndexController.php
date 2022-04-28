<?php

namespace App\Controllers\Front;

use App\Controllers\FrontController;
use CoffeeCode\Router\Router;

class IndexController extends FrontController
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        echo $this->template->render("front/front.index", [
            "title" => "Página Inicial"
        ]);
        return;
    }
}
