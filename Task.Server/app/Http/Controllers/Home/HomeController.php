<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;
use Task\Core\Routing\RoutingName;

class HomeController extends BaseController
{
    public function index()
    {
        return $this->view(RoutingName::HOME_INDEX);
    }
}
