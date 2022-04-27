<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        require_once CONF_BASE_PATH . "/resources/views/admin/index.php";
    }
}
