<?php

function headerNav() {
    if (isset($_SESSION) && !empty($_SESSION)) {
        require view('header/header_log.php');
    }
    else {
        require view('header/header.php');
    }
    return $header;
}