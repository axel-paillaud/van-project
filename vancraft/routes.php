<?php

$router->get('/', 'src/controllers/homepage.php');
$router->get('/home', 'src/controllers/homepage.php');
$router->get('/subscribe', 'src/controllers/log.php');
$router->post('/submit-subscribe', 'src/controllers/log.php');
$router->get('/log-in', 'src/controllers/log.php');
$router->post('/submit-log-in', 'src/controllers/log.php');
$router->get('/log-out', 'src/controllers/log.php');
$router->get('/post', 'src/controllers/post.php');
$router->post('/post', 'src/controllers/post.php');
$router->get('/post-article', 'src/controllers/post.php');
$router->post('/submit-post', 'src/controllers/post.php');
$router->get('/api/tags', 'src/controllers/api/tags.php');
