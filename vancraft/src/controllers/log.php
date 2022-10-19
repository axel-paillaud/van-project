<?php

require_once('src/model/user.php');

function subscribe(bool $add_user_succes) {
    $add_user_succes;
    require('templates/log/subscribe.php');
}

function addUser($name, $email, $password) : bool {
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $userRepository = new UserRepository();

    $userRepository->checkIfExist($name, $email);
    $add_user_succes = $userRepository->subscribeUser($name, $email, $hash_password);
    return $add_user_succes;
}