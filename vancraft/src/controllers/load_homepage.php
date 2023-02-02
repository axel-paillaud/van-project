<?php

include_once 'src/controllers/homepage.php';

$content = homepage();
$header = headerNav();
$sidebar = sidebar(1);
$footer = footer();
require 'templates/layout.php';