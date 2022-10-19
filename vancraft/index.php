<?php

require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/sidebar.php');
require_once('src/controllers/footer.php');
require_once('src/controllers/log.php');

try {
    $header = header_nav();
    $sidebar = sidebar(1);
    $footer = footer();
    echo $header;
    echo $sidebar;

    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'subscribe') {
            subscribe(false);
        }
        elseif ($_GET['action'] === 'submit-subscribe') {
            $add_user_succes = addUser($_POST['name'], $_POST['email'], $_POST['password']);

            subscribe($add_user_succes);
        }
    }
    else {
        homepage();
    }

    echo $footer;
} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    echo $errorMsg;
}