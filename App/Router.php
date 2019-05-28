<?php

namespace App;

use Exception;

class Router
{
    private $_ctrl;


    public function routeRequest()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = 'layout/login';
        }

        $url = explode('/', filter_var($url, FILTER_SANITIZE_URL));

        $controller = '\App\Controller\\' . ucfirst($url[0]) . 'Controller';
        $action = $url[1];
        $this->_ctrl = new $controller();
        $this->_ctrl->$action();
    }
}