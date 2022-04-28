<?php

namespace App\Core;

class Seo
{
    /** @var \CoffeeCode\Optimizer\Optimizer */
    private $engine;

    public function __construct()
    {
        $this->engine = (new \CoffeeCode\Optimizer\Optimizer());
    }

    /**
     * @param string $title
     * @param string $description
     * @param string|null $url
     * @param string|null $image
     * @param bool $follow
     * @return string
     */
    public function render(string $title, string $description, ?string $url = null, ?string $image = null, bool $follow = true): string
    {
        $this->engine->optimize($title, $description, $url ?? "", $image ?? "", $follow);
        return $this->engine->render();
    }
}
