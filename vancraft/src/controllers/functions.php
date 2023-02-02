<?php

function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function abort($code = 404) {
    http_response_code($code);
    $header = headerNav();
    $content = homepage("Erreur : cette page est inexistante ou introuvable", true);
    $footer = footer();
    $sidebar = sidebar();
}