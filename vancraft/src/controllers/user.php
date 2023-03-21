<?php

use Model\Post\PostRepository;
use Model\User\UserRepository;
use Validator\User\UserValidator;

require_once base_path('src/model/post.php');
require_once base_path('src/model/user.php');
require_once base_path('src/validators/userValidator.php');

$userValidator = new UserValidator();
$userRepository = new UserRepository();

$user_id = $userValidator->validateId($_GET["user-id"]);
$user = $userRepository->getUser($user_id);
dd($user);

echo $twig->render('user/user.php', [

]);