<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/home'             => 'src/controllers/home/homepage.php',
    '/'                 => 'src/controllers/home/homepage.php',
    '/subscribe'        => 'src/controllers/log.php',
    '/submit-subscribe' => 'src/controllers/log.php',
    '/log-in'           => 'src/controllers/log.php',
    '/submit-log-in'    => 'src/controllers/log.php',
    '/log-out'          => 'src/controllers/log.php',
    '/post-article'     => 'src/controllers/post.php',
    '/submit-post'      => 'src/controllers/post.php',
    '/api/tags'         => 'src/controllers/api/tags.php',
];

function routeToControllers($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        return $routes[$uri];
    }
    else {
        abort();
        return 'src/controllers/home/homepage.php';
    }
}

try {
    require routeToControllers($uri, $routes);
}
catch (Exception $e) {
    $message = $e->getMessage();
    $bad_message = true;
    require 'src/controllers/home/homepage.php';
}