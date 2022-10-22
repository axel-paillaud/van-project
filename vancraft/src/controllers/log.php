<?php

require_once('src/model/user.php');

function subscribe($subscribe_succes = false) {
    require('templates/log/subscribe.php');
}

function addUser($name, $email, $password, $confirm_password) {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $userRepository = new UserRepository();

    if(($userRepository->checkIfExist($name, $email)) === false) {
        $subscribe_succes = $userRepository->subscribeUser($name, $email, $hash_password, $password, $confirm_password);
        return $subscribe_succes;
    }
    else {
        throw new Exception("L'email ou le nom d'utilisateur existe déjà.");
    }
}

function log_in() {
    require('templates/log/log-in.php');
}

function log_in_attempt($name, $email, $password) {

    $userRepository = new UserRepository();
    $check = $userRepository->checkIfExist($name, $email);
    if ($check['name_and_email_check'] === true) {
        echo "L'email et le nom existe biennnnnnnnnnnnnnnnnn.";
        return $message ="succes";
    }

}