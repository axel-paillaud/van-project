<?php

include_once base_path('src/controllers/home/homepage.php');

$content = homepage();
$header = headerNav();
$sidebar = sidebar(1);
$footer = footer();
view('layout.php', [
    'title' => "Vancraft - Page d'accueil",
    'header' => $header,
    'sidebar' => $sidebar,
    'footer' => $footer,
    'content' => $content
]);
