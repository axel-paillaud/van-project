<?php

require_once('src/model/post.php');


function homepage() {
    $limit = "LIMIT 0, 15";
    $orderBy = "votes";
    //for the moment, the variable limit and orderBy aren't used in model/post.php

    //test array before database to make profile integration into post
    $profiles = [
        $name = "Jean-luc",
        $pictures = "images/users/arthur21/profile_pictures/01.jpg"
    ];

    $profiles_2 = [
        $name = "Shaun",
        $pictures = "images/users/shaun/profile_pictures/PaillaudAxelPhoto.png"
    ];


    $postRepository = new PostRepository();

    $posts = $postRepository->getPosts($limit, $orderBy);

    require('templates/home/homepage.php');
}