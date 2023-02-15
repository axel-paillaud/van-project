<?php

use Model\User\UserRepository;
require_once base_path('src/model/user.php');

function addUser($name, $email, $password, $confirm_password) {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $userRepository = new UserRepository();

    $check = $userRepository->checkIfExist($name, $email);
    if ($check['name_check'] === false && $check['email_check'] === false) {
        if (!mkdir("assets/images/users/" . $name . "/profile_images", 0733, true) ||
        !mkdir("assets/images/users/" . $name . "/posts_images", 0733, true)) {
            throw new Exception("Impossible de créer les dossiers de l'utilisateur sur le serveur");
        }
        $subscribe_succes = $userRepository->subscribeUser($name, $email, $hash_password, $password, $confirm_password);
        return $subscribe_succes;
    }
    else {
        throw new Exception("L'email ou le nom d'utilisateur existe déjà.");
    }
}

function log_in_attempt($name, $email, $password) {

    $userRepository = new UserRepository();
    $check = $userRepository->checkIfExist($name, $email);
    if ($check['name_and_email_check']) {
        if ($userRepository->checkPassword($name, $email, $password)) {
            session_destroy();
            $user = $userRepository->logUser($name, $email);
            if(session_start())
            {
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->name;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_creation_account_date'] = $user->creation_date;
                $_SESSION['user_last_connexion'] = $user->last_connexion;
                $_SESSION['user_numbers_of_questions'] = $user->numbers_of_questions;
                $_SESSION['user_numbers_of_answers'] = $user->numbers_of_answers;
                $_SESSION['user_image_profile_sm'] = $user->image_profile_url;
                return $message ="Bienvenue, " . $_SESSION['user_name'];
            }
            else {
                throw new Exception("Impossible d'ouvrir la session.");
            }
        }
        else {
            throw new Exception("Le mot de passe est invalide.");
        }
    }
    else {
        throw new Exception("L'email ou le nom d'utilisateur est incorrect.");
    }
}

if ($uri === '/log-in') {
    echo $twig->render('log/log-in.php');
}
else if ($uri === '/submit-log-in') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password']))
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        $message = log_in_attempt($name, $email, $_POST['password']);

        require '../src/controllers/homepage.php';

    }
    else {
        throw new Exception("Un problème est survenu sur un des champs du formulaire.");
    }
}
else if ($uri === '/subscribe') {
    if (!isset($subscribe_succes)) {
        $subscribe_succes = false;
    };

    echo $twig->render('log/subscribe.php', [
        'subscribe_succes' => $subscribe_succes,
    ]);
}
else if ($uri === '/submit-subscribe') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password']))
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        $subscribe_succes = addUser($name, $email, $_POST['password'], $_POST['confirm-password']);

        echo $twig->render('log/subscribe.php', [
            'subscribe_succes' => $subscribe_succes,
        ]);
    }
    else {
        throw new Exception("Un problème est survenu sur un des champs du formulaire.");
    }
}
elseif ($uri === "/log-out") {
    session_destroy();
    session_start();

/*     view('layout.php', [
        'header' => headerNav(),
        'sidebar' => sidebar(1),
        'content' => homepage("Vous vous êtes bien déconnecté", true),
        'footer' => footer(),
        'title' => "Vancraft - Page d'accueil"
    ]); */

    $message = "Vous vous êtes bien déconnecté";
    $bad_message = true;

    require '../src/controllers/homepage.php';

}
