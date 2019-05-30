<?php
define('ROOTDIR', dirname(__DIR__));
define("APPDIR", ROOTDIR . '/App');

require APPDIR . '/App.php';

App\App::load();

$router = new \App\Router();
$router->routeRequest();