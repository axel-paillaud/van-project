<?php

require_once 'src/model/user.php';
require_once 'src/controllers/header.php';
require_once 'src/controllers/sidebar.php';
require_once 'src/controllers/footer.php';

function subscribe($subscribe_succes = false) {
    require('templates/log/subscribe.php');
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
    require('templates/log/log-in.php');
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

if ($uri = '/log-in') {
    $content = logIn();
    $header = headerNav();
    $sidebar = sidebar();
    $footer = footer();
    require 'templates/layout.php';
}
else if ($uri = '/submit-log-in') {
    echo "Vous souhaiter vous connecter";
}
