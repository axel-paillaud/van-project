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

if ($uri === "/post") {
    echo $_GET["id"];
    $postRepository = new PostRepository();
    $post = $postRepository->getPost($_GET["id"]);
    dd($post);
    echo $twig->render("article/post.php", [

    ]);
}
else if ($uri === "/post-article") {
    echo $twig->render('article/send_post.php', [
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
        $postRepository->sendPost($_SESSION, $title, $content, $tags, $imageDb);
    }
    else {
        $postRepository->sendPost($_SESSION, $title, $content, $tags);
    }
    require base_path('src/controllers/homepage.php');
}
