<?php

use Model\Tag\TagRepository;
use Model\Post\PostRepository;
use Validator\Post\postValidator;
use Lib\Post\postLib;
require_once base_path('src/model/post.php');
require_once base_path('src/model/user.php');
require_once base_path('src/model/tag.php');
require_once base_path('src/controllers/lib/post.php');
require_once base_path('src/validators/postValidator.php');

if ($uri === "/post-article") {
    echo $twig->render('article/post.php', [
        'page' => 'post',
    ]);
}
else if ($uri === "/submit-post") {
    $postValidator = new postValidator();
    $postLib = new postLib();

    $images = $postLib->sortFiles($_FILES["image"]);
    $postValidator->userValidator($_SESSION);
    $images = $postValidator->imageValidator($images);
    $title = $postValidator->titleValidator($_POST["title"]);
    $content = $postValidator->contentValidator($_POST["content"]);
    $tags = $postValidator->tagsValidator($_POST["tag"]);

    if($images) {
        $postLib->addImgToServer($_FILES["image"], $_SESSION); //TODO : if user dir doesn't exist, create it
        die();
        $postLib->addImgToDb($_FILES["image"], $_SESSION); //TODO
    }
    $postLib->addPost($title, $content, $tags); //TODO

    dd($_POST);
    if (isset($_POST['title'], $_POST['content'], $_POST['tag'])) {
        echo "hello";

        require 'home/homepage.php';
    }
    else {
        throw new Exception("Un problème est survenu sur l'un des champs du formulaire.");
    }
}
