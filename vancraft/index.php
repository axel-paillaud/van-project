<?php
session_start();

require_once 'src/controllers/footer.php';
require_once 'src/controllers/log.php';
require_once 'src/controllers/post.php';
require 'src/model/functions.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$router = [
    '/accueil' => 'src/controllers/homepage.php',
    '/' => 'src/controllers/homepage.php',
];

try {
    if ($uri === '/subscribe') {
        $sidebar = sidebar(1);
        $content = subscribe();
    }
    elseif ($uri === '/submit-subscribe') {
        if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password']))
        {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);

            $subscribe_succes = addUser($name, $email, $_POST['password'], $_POST['confirm-password']);

            $sidebar = sidebar(1);
            $content = subscribe($subscribe_succes);
        }
        else {
            throw new Exception("Une erreur s'est produite. S'il vous plait envoyer un mail au webmaster : a.paillaud75@gmail.com pour qu'il
            corrige le problème au plus vite.");
        }
    }
    elseif ($uri === '/log-in') {
        $sidebar = sidebar(1);
        $content = log_in();
    }
    elseif ($uri === '/submit-log-in')
    {
        if (isset($_POST['name'], $_POST['email'], $_POST['password']))
        {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);

            $message = log_in_attempt($name, $email, $_POST['password']);

            $sidebar = sidebar(1);
            $content = homepage($message);
        }
    }
    elseif ($uri === "/log-out") {
        session_destroy();
        session_start();
        $sidebar = sidebar(1);
        $content = homepage();
    }
    elseif ($uri === "/post-article") {
        $sidebar = sidebar();
        $content = post();
    }
    elseif ($uri === "/submit-post") {
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
    else {
        include 'src/controllers/homepage.php';
    }

} catch (Exception $e) {
    $errorMsg = $e->getMessage();
    $bad = true;
    $header = headerNav();
    $sidebar = sidebar(1);
    $content = homepage($errorMsg, $bad);
    $footer = footer();
    require_once('templates/layout.php');
}