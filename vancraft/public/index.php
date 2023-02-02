<?php
session_start();

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';
require base_path('src/controllers/header.php');
require base_path('src/controllers/footer.php');
include base_path('src/controllers/sidebar.php');
require base_path('src/controllers/home/homepage.php');
require base_path('router.php');