<?php

function headerNav() {
    if (isset($_SESSION) && !empty($_SESSION)) {
        require('templates/header/header_log.php');
    }
    else {
        require('templates/header/header.php');
    }
    return $header;
}