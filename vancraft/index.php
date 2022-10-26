<?php
session_start();

require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/sidebar.php');
require_once('src/controllers/footer.php');
require_once('src/controllers/log.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'subscribe') {
            header_nav();
            sidebar(1);
            subscribe();
            footer();
        }
        elseif ($_GET['action'] === 'submit-subscribe') {
            if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password']))
            {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);

                $subscribe_succes = addUser($name, $email, $_POST['password'], $_POST['confirm-password']);

                header_nav();
                sidebar(1);
                subscribe($subscribe_succes);
                footer();
            }
            else {
                throw new Exception("Une erreur s'est produite. S'il vous plait envoyer un mail au webmaster : a.paillaud75@gmail.com pour qu'il
                corrige le problème au plus vite.");
            }
        }
        elseif ($_GET['action'] === 'log-in') {
            header_nav();
            sidebar(1);
            log_in();
            footer();
        }
        elseif ($_GET['action'] === 'submit-log-in')
        {
            if (isset($_POST['name'], $_POST['email'], $_POST['password']))
            {
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);

                $message = log_in_attempt($name, $email, $_POST['password']);

                header_nav();
                sidebar(1);
                homepage($message);
                footer();
            }
        }
        elseif ($_GET['action'] === "log-out") {
            session_destroy();
            session_start();
            header_nav();
            sidebar(1);
            homepage();
            footer();
        }
    }
    else {
        header_nav();
        sidebar(1);
        homepage();
        footer();
    }

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    echo $errorMsg;
}