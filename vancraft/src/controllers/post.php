<?php

use Model\Tag\TagRepository;
use Model\Post\PostRepository;
use Validator\Post\PostValidator;
use Lib\Post\PostLib;
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
    $postValidator = new PostValidator();
    $postLib = new PostLib();
    $postRepository = new PostRepository();

    $images = $postLib->sortFiles($_FILES["image"]);
    $postValidator->userValidator($_SESSION);
    $images = $postValidator->imageValidator($images);
    $title = $postValidator->titleValidator($_POST["title"]);
    $content = $postValidator->contentValidator($_POST["content"]);
    $tags = $postValidator->tagsValidator($_POST["tag"]);

    if($images) {
        $imageDb = $postLib->addImgToServer($_FILES["image"], $_SESSION);
        $postRepository->sendPost($_SESSION, $title, $content, $tags, $imageDb); //TODO
    }
    $postRepository->sendPost($_SESSION, $title, $content, $tags); //TODO

    if (isset($_POST['title'], $_POST['content'], $_POST['tag'])) {
        echo "hello";

        require 'home/homepage.php';
    }
    else {
        throw new Exception("Un problème est survenu sur l'un des champs du formulaire.");
    }
}
