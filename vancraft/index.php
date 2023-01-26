<?php
session_start();

require_once('src/controllers/header.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/sidebar.php');
require_once('src/controllers/footer.php');
require_once('src/controllers/log.php');
require_once('src/controllers/post.php');

try {
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        if ($_GET['action'] === 'subscribe') {
            headerNav();
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

                headerNav();
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
            headerNav();
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

                headerNav();
                sidebar(1);
                homepage($message);
                footer();
            }
        }
        elseif ($_GET['action'] === "log-out") {
            session_destroy();
            session_start();
            headerNav();
            sidebar(1);
            homepage();
            footer();
        }
        elseif ($_GET['action'] === "post-article") {
            headerNav();
            sidebar();
            post();
            footer();
        }
        elseif ($_GET['action'] === "submit-post") {
            if (isset($_POST['title'], $_POST['content'], $_POST['tags'])) {
                $message = submit_post($_POST['title'], $_POST['content'], $_POST['tags']);
                headerNav();
                sidebar(1);
                homepage($message);
                footer();
            }
            else {
                throw new Exception("Une erreur s'est produite. S'il vous plait envoyer un mail au webmaster : a.paillaud75@gmail.com pour qu'il
                corrige le problème au plus vite.");
            }
        }
    }
    else {
        $header = headerNav();
        $sidebar = sidebar(1);
        $content = homepage();
        $footer = footer();
        require('templates/layout.php');
    }

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    $bad = true;
    headerNav();
    sidebar(1);
    homepage($errorMsg, $bad);
    footer();
}