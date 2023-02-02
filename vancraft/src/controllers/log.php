<?php

require_once base_path('src/model/user.php');

function subscribe($subscribe_succes = false) {
    require base_path('templates/log/subscribe.php');
    return $content;
}

function addUser($name, $email, $password, $confirm_password) {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $userRepository = new UserRepository();

    $check = $userRepository->checkIfExist($name, $email);
    if ($check['name_check'] === false && $check['email_check'] === false) {
        if (!mkdir("images/users/" . $name . "/profile_pictures", 0733, true) ||
        !mkdir("images/users/" . $name . "/posts_pictures", 0733, true)) {
            throw new Exception("Impossible de créer les dossiers de l'utilisateur sur le serveur");
        }
        $subscribe_succes = $userRepository->subscribeUser($name, $email, $hash_password, $password, $confirm_password);
        return $subscribe_succes;
    }
    else {
        throw new Exception("L'email ou le nom d'utilisateur existe déjà.");
    }
}

function logIn() {
    require base_path('templates/log/log-in.php');
    return $content;
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
    view('layout.php', [
        'header' => headerNav(),
        'sidebar' => sidebar(),
        'content' => logIn(),
        'footer' => footer(),
    ]);
}
else if ($uri === '/submit-log-in') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password']))
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        $message = log_in_attempt($name, $email, $_POST['password']);

        view('layout.php', [
            'header' => headerNav(),
            'sidebar' => sidebar(1),
            'content' => homepage($message),
            'footer' => footer(),
        ]);
    }
}
else if ($uri === '/subscribe') {
    view('layout.php', [
        'header' => headerNav(),
        'sidebar' => sidebar(1),
        'content' => subscribe(),
        'footer' => footer(),
    ]);
}
else if ($uri === '/submit-subscribe') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm-password']))
    {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        $subscribe_succes = addUser($name, $email, $_POST['password'], $_POST['confirm-password']);

        view('layout.php', [
            'header' => headerNav(),
            'sidebar' => sidebar(1),
            'content' => subscribe($subscribe_succes),
            'footer' => footer(),
        ]);
    }
    else {
        throw new Exception("Un problème est survenu sur un des champs du formulaire.");
    }
}
elseif ($uri === "/log-out") {
    session_destroy();
    session_start();
    view('layout.php', [
        'header' => headerNav(),
        'sidebar' => sidebar(1),
        'content' => homepage("Vous vous êtes bien déconnecté", true),
        'footer' => footer(),
    ]);
}
