<?php

/* require_once base_path('src/model/tag.php'); */

$tags = [
    'value' => 'test',
    'value2' => 'hello, there'
];

$tags = json_encode($tags);

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");

echo $tags;