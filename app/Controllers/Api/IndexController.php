<?php

namespace App\Controllers\Api;

use App\Controllers\ApiController;

class IndexController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function index()
    {
        echo json_encode([
            "status" => 200,
            "api" => "Hello World!"
        ]);
        return;
    }
}
