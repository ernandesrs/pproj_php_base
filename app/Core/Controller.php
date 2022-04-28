<?php

namespace App\Core;

use App\Core\Template;
use CoffeeCode\Router\Router;

class Controller
{
    /** @var Template */
    protected $template;

    /** @var Router */
    protected $router;

    /** @var Seo */
    protected $seo;

    public function __construct(Router $router)
    {
        $this->template = (new Template(CONF_BASE_PATH . "/resources/views"));
        $this->router = $router;
        $this->seo = new Seo();

        $this->template->addData(["router" => $this->router]);
    }
}
