<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use CoffeeCode\Router\Router;

class IndexController extends AdminController
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    public function index()
    {
        echo $this->template->render("admin/admin.index", [
            "title" => "Painel Administrativo"
        ]);
        return;
    }
}
