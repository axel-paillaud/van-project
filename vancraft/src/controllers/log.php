<?php

require_once('src/model/user.php');

function subscribe() {
    
    require('templates/log/subscribe.php');
}

function addUser($name, $email, $password) {
    $userRepository = new UserRepository();

    $userRepository->subscribeUser($name, $email, $password);
}