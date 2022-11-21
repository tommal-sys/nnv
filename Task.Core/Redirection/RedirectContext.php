<?php

namespace Task\Core\Redirection;

class RedirectContext
{
    public $type;

    public $status;

    public $params;

    public $url;

    public $routeName;

    public $message;
    
    public $notifications = [];

    public $withInput = false;

    public $cookie;
}