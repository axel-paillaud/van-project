<?php

require_once('src/model/post.php');
require_once('src/model/user.php');
require_once('src/model/tag.php');

function post() {
    require('templates/article/post.php');
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

        $message = "Votre question à bien été publiée.";
        return $message;
    }

}