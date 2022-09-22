<?php

function sidebar(int $which_page) {
    $which_page = 1;
    $here = "id=here";
    require('templates/sidebar/sidebar.php');
    return $sidebar;
}