<?php

namespace App\Controllers\Front;

use App\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        require_once CONF_BASE_PATH . "/resources/views/front/index.php";
    }
}