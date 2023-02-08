<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/home'             => 'src/controllers/home/index.php',
    '/'                 => 'src/controllers/home/index.php',
    '/subscribe'        => 'src/controllers/log.php',
    '/submit-subscribe' => 'src/controllers/log.php',
    '/log-in'           => 'src/controllers/log.php',
    '/submit-log-in'    => 'src/controllers/log.php',
    '/log-out'          => 'src/controllers/log.php',
    '/post-article'     => 'src/controllers/post.php',
    '/submit-post'      => 'src/controllers/post.php',
];

function routeToControllers($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    }
    else {
        abort();
    }
}

try {
    routeToControllers($uri, $routes);
}
catch (Exception $e) {
    $errorMsg = $e->getMessage();
    $bad = true;
    $header = headerNav();
    $sidebar = sidebar(1);
    $content = homepage($errorMsg, $bad);
    $footer = footer();
    require_once('templates/layout.php');
}