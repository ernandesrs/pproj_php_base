<?php

namespace App\Controllers\Front;

use App\Controllers\FrontController;
use App\Core\Alert;
use CoffeeCode\Router\Router;

class TestController extends FrontController
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        if ($test = filter_input(INPUT_GET, "test")) {
            if (method_exists($this, $test))
                $this->$test();
            else {
                Alert::warning("Ops. Método não encontrado.")->session();
                redirect($this->router->route("front.test"));
            }

            return;
        }

        echo $this->template->render("front/tests/index", [
            "head" => $this->seo->render("Testes", "Página de testes", "", "", false)
        ]);
        return;
    }

    public function fixed_message()
    {
        Alert::info("Mensagem fixa de teste na sessão")->session();
        redirect($this->router->route("front.test"));
    }

    public function float_message()
    {
        Alert::info("Mensagem flutuante de teste na sessão")->floating()->session();
        redirect($this->router->route("front.test"));
    }
}
