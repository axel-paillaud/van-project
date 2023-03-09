<?php

namespace Api;

use \Model\Tag\TagRepository;
require_once base_path('src/model/tag.php');

function getTags() {
    $tagRepository = new TagRepository();

    $tags = $tagRepository->getTags();
    return $tags;
}

$tags = getTags();

$tags = json_encode($tags);

header("Content-type: application/json");

echo $tags;