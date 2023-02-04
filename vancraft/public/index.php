<?php
session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';

//Twig init
require_once base_path('vendor/autoload.php');
$loader = new \Twig\Loader\FilesystemLoader(base_path('templates'));
$twig = new \Twig\Environment($loader); //add cache option here to compile template and load faster

require base_path('src/controllers/header.php');
require base_path('src/controllers/footer.php');
include base_path('src/controllers/sidebar.php');
require base_path('src/controllers/home/homepage.php');
require base_path('router.php');