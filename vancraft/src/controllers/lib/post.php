<?php

namespace Lib\Post;
use Exception;
use Model\Tag\TagRepository;

class Image {
    public string $name;
    public string $type;
    public string $tmpName;
    public int $error;
    public int $size;
}


class Post {
    public string $title;
    public string $content;
    public array $tags;
}

class postLib {
    public function sortFiles($files) {
        $images = [];

        for ($i = 0; $i < count($files["name"]); $i++) {
            $image = new Image();

            $image->name = $files["name"][$i];
            $image->type = $files["type"][$i];
            $image->tmpName = $files["tmp_name"][$i];
            $image->error = $files["error"][$i];
            $image->size = $files["size"][$i];

            $images[] = $image;
        }
        return $images;
    }
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