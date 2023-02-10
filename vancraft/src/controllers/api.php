<?php

require_once base_path('src/model/tag.php');

function getTags() {
    $tagRepository = new TagRepository();

    $tags = $tagRepository->getTags();
    return $tags;
}

$tags = getTags();

$tags = json_encode($tags);

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

echo $tags;