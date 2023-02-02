<?php

function headerNav() {
    if (isset($_SESSION) && !empty($_SESSION)) {
        require base_path('templates/header/header_log.php');
    }
    else {
        require base_path('templates/header/header.php');
    }
    return $header;
}