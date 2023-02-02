<?php

function headerNav() {
    if (isset($_SESSION) && !empty($_SESSION)) {
        $header = view('header/header_log.php');
    }
    else {
        $header = view('header/header.php');
    }
    return $header;
}