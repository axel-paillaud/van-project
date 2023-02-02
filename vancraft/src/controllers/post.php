<?php

require_once base_path('src/model/post.php');
require_once base_path('src/model/user.php');
require_once base_path('src/model/tag.php');

function post() {
    require view('article/post.php');
    return $content;
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

if ($uri === "/post-article") {
    $header = headerNav();
$content = post();
$sidebar = sidebar();
$footer=  footer();
include view('layout.php');
}
else if ($uri === "/submit-post") {
    if (isset($_POST['title'], $_POST['content'], $_POST['tags'])) {
        $message = submit_post($_POST['title'], $_POST['content'], $_POST['tags']);
        headerNav();
        sidebar(1);
        homepage($message);
        footer();
    }
    else {
        throw new Exception("Un problème est survenu sur l'un des champs du formulaire.");
    }
}
