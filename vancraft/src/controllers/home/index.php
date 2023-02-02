<?php

include_once base_path('src/controllers/home/homepage.php');

$content = homepage();
$header = headerNav();
$sidebar = sidebar(1);
$footer = footer();
require view('layout.php');