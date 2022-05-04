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

    /**
     * @return void
     */
    public function index(): void
    {
        echo $this->template->render("front/front.index", [
            "head" => $this->seo->render(
                "Página inicial",
                "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat placeat error dolor sapiente minus sed!",
                $this->router->route("front.index")
            ),
            "title" => "Página Inicial"
        ]);
        return;
    }

    /**
     * @return void
     */
    public function about(): void
    {
        echo $this->template->render("front/front.about", [
            "head" => $this->seo->render(
                "Sobre | " . CONF_APP_NAME,
                "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugiat placeat error dolor sapiente minus sed!",
                $this->router->route("front.index")
            ),
            "title" => "Sobre | " . CONF_APP_NAME
        ]);
        return;
    }
}
