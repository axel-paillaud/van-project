<?php

require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/sidebar.php');

$header = header_nav();
$sidebar = sidebar(1);

echo $header;
echo $sidebar;

homepage();