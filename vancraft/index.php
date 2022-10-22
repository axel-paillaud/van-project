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
            subscribe();
        }
        elseif ($_GET['action'] === 'submit-subscribe') {
            if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password']))
            {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);

                $subscribe_succes = addUser($name, $email, $_POST['password'], $_POST['confirm-password']);
                subscribe($subscribe_succes);
            }
            else {
                throw new Exception("Une erreur s'est produite. S'il vous plait envoyer un mail au webmaster : a.paillaud75@gmail.com pour qu'il
                corrige le problème au plus vite.");
            }
        }
        if ($_GET['action'] === 'log-in') {
            log_in();
        }
        elseif ($_GET['action'] === 'submit-log-in')
        {
            if (isset($_POST['name'], $_POST['email'], $_POST['password']))
            {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);

                $message = log_in_attempt($name, $email, $_POST['password']);

                homepage($message);
            }
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