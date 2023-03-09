<?php
session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';
require base_path('src/core/router.php');

//Twig init
require_once base_path('vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader(base_path('templates'));
$twig = new \Twig\Environment($loader); //add cache option here to compile template and load faster

if (isset($_SESSION) && !empty($_SESSION)) {
    $twig->addGlobal('user', $_SESSION);
}

$router = new \Core\Router();
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

// I would like to require controller inside route object, but I have scope variable
// problem, for example with Twig. I don't know if its a good usage to get out
// the  variable "controller" like that ?
try {
    $controller = $router->route($uri, $method);
    require $controller;
}
catch (Exception $e) {
    $message = $e->getMessage();
    $bad_message = true;
    require base_path('src/controllers/homepage.php');
}