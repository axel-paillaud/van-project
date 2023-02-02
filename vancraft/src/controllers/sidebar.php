<?php

//which_page arg is for changing the good color of link inside sidebar
function sidebar(int $which_page = 1) {
    $here = "id=here";
    $sidebar = view('sidebar/sidebar.php');
    return $sidebar;
}