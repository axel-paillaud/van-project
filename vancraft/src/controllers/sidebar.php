<?php

//which_page arg is for changing the good color of link inside sidebar
function sidebar(int $which_page = 1) {
    $here = "id=here";
    require view('sidebar/sidebar.php');
    return $sidebar;
}