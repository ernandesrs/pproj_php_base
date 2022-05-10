<?php

namespace App\Core;

use CoffeeCode\DataLayer\DataLayer;

class Model extends DataLayer
{
    /**
     * @param string $table
     * @param array $required
     * @param string $primary
     * @param bool $timestamps
     */
    public function __construct(string $table, array $required = [], string $primary = "id", bool $timestamps = true)
    {
        parent::__construct($table, $required, $primary, $timestamps);
    }

    public function __get($name)
    {
        return $this->data->$name ?? null;
    }
}
