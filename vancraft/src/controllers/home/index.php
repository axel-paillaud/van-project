<?php

include_once base_path('src/controllers/home/homepage.php');

$footer = footer();

view('layout.php', [
    'title' => "Vancraft - Page d'accueil",
    'header' => headerNav(),
    'content' => homepage(),
    'sidebar' => sidebar(),
    'footer' => footer()
]);
