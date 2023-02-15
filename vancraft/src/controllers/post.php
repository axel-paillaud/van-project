<?php

use Model\Tag\TagRepository;
use Validator\Post\postValidator;
require_once base_path('src/model/post.php');
require_once base_path('src/model/user.php');
require_once base_path('src/model/tag.php');
require_once base_path('src/validators/postValidator.php');

class Post {
    public string $title;
    public string $content;
    public array $tags;
}

function submit_post(string $title, string $content, string $tags) {
    if (empty($title) || empty($content) || empty($tags)) {
        throw new Exception("Erreur : Un des champs est vide.");
    }
    else {
        $tagRepository = new TagRepository();
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $arr_tags = $tagRepository->computeTags($tags);

        $tagRepository->addTags($arr_tags);

        $message = "Votre question a bien été publiée.";
        return $message;
    }
}

$postValidator = new postValidator();

if ($uri === "/post-article") {
    echo $twig->render('article/post.php', [
        'page' => 'post',
    ]);
}
else if ($uri === "/submit-post") {
    $postValidator->fileValidator($_FILES);
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    dd($_FILES["image"]);
    if (isset($_POST['title'], $_POST['content'], $_POST['tags'])) {
        $message = submit_post($_POST['title'], $_POST['content'], $_POST['tags']);

        require 'home/homepage.php';
    }
    else {
        throw new Exception("Un problème est survenu sur l'un des champs du formulaire.");
    }
}
