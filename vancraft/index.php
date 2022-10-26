<?php
session_start();

require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/sidebar.php');
require_once('src/controllers/footer.php');
require_once('src/controllers/log.php');

try {
    $header = header_nav();
    $sidebar = sidebar(1);
    $footer = footer();

    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'subscribe') {
            echo $header;
            echo $sidebar;
            subscribe();
            echo $footer;
        }
        elseif ($_GET['action'] === 'submit-subscribe') {
            if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password']))
            {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);

                $subscribe_succes = addUser($name, $email, $_POST['password'], $_POST['confirm-password']);

                echo $header;
                echo $sidebar();
                subscribe($subscribe_succes);
                echo $footer;
            }
            else {
                throw new Exception("Une erreur s'est produite. S'il vous plait envoyer un mail au webmaster : a.paillaud75@gmail.com pour qu'il
                corrige le problème au plus vite.");
            }
        }
        if ($_GET['action'] === 'log-in') {
            echo $header;
            echo $sidebar;
            log_in();
            echo $footer;
        }
        elseif ($_GET['action'] === 'submit-log-in')
        {
            if (isset($_POST['name'], $_POST['email'], $_POST['password']))
            {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);

                $message = log_in_attempt($name, $email, $_POST['password']);

                echo $header;
                echo $sidebar;
                homepage($message);
                echo $footer;
            }
        }
    }
    else {
        echo $header;
        echo $sidebar;
        homepage();
        echo $footer;
    }

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    echo $errorMsg;
}