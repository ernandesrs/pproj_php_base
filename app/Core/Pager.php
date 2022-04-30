<?php

namespace App\Core;

use CoffeeCode\Paginator\Paginator;

class Pager
{
    /** @var Paginator */
    private $engine;

    /**
     * @param string|null $link
     */
    public function __construct(?string $link = null)
    {
        $this->engine = new Paginator($link);
    }

    /**
     * @param int $rows
     * @param int $limit
     * @param int|null $page
     * @param int $range
     * @return Pager
     */
    public function pager(int $rows, int $limit = 12, ?int $page = null, int $range = 3): Pager
    {
        $this->engine->pager($rows, $limit, $page, $range);
        return $this;
    }

    /**
     * @param string|null $cssClass
     * @return string|null
     */
    public function render(?string $cssClass = null): ?string
    {
        return $this->engine->render($cssClass);
    }
}
