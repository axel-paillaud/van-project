<?php
session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';

//Twig init
require_once base_path('vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader(base_path('templates'));
$twig = new \Twig\Environment($loader); //add cache option here to compile template and load faster

if (isset($_SESSION) && !empty($_SESSION)) {
    $twig->addGlobal('user', $_SESSION);
}

require base_path('router.php');
