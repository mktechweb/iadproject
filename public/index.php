<?php
define('ROOTDIR', dirname(__DIR__));
define("APPDIR", ROOTDIR . '/App');
define("PUBLICPATH", ROOTDIR . '/public');

require APPDIR . '/App.php';

App\App::load();

$router = new \App\Router();
$router->routeRequest();