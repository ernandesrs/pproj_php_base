<?php

namespace App\Controllers\Front;

use App\Controllers\FrontController;
use CoffeeCode\Router\Router;

class AuthController extends FrontController
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    /**
     * @return void
     */
    public function login(): void
    {
        echo $this->template->render("auth/login", [
            "head" => $this->seo->render(CONF_APP_NAME . " | Login", "Página de login", null, null, false)
        ]);
        return;
    }

    /**
     * @param array $data
     * @return void
     */
    public function authenticate(array $data = []): void
    {
        var_dump($data);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        echo $this->template->render("auth/register", [
            "head" => $this->seo->render(CONF_APP_NAME . " | Registro", "Página de registro", null, null, false)
        ]);
        return;
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data = []): void
    {
        var_dump($data);
    }
}
