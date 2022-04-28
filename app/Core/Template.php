<?php

namespace App\Core;

use League\Plates\Engine;

class Template
{
    /** @var \League\Plates\Engine */
    private $engine;

    /**
     * @param string $pathToTemplates
     */
    public function __construct(string $pathToTemplates, string $ext = "php")
    {
        $this->engine = new \League\Plates\Engine($pathToTemplates, $ext);
    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    public function render(string $view, array $data = []): string
    {
        $this->addData($data);

        return $this->engine->render($view, $data);
    }

    /**
     * @param array $data
     * @return Engine
     */
    public function addData(array $data): Engine
    {
        return $this->engine->addData($data);
    }
}
