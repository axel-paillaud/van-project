<?php
session_start();

require_once 'src/controllers/header.php';
require_once 'src/controllers/footer.php';
include_once 'src/controllers/sidebar.php';
require_once 'src/controllers/homepage.php';
require_once 'src/controllers/functions.php';
require 'router.php';
