<?php

require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/sidebar.php');
require_once('src/controllers/footer.php');
require_once('src/controllers/log.php');

$header = header_nav();
$sidebar = sidebar(1);
$footer = footer();
echo $header;
echo $sidebar;

if (isset($_GET['action']) && $_GET['action'] !== '') {
    if ($_GET['action'] === 'subscribe') {
        subscribe();
    }
}
else {
    homepage();
}

echo $footer;