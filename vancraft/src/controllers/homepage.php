<?php

require_once('src/model/post.php');
require_once('src/model/user.php');


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
    $userRepository = new UserRepository();

    $posts = $postRepository->getPosts($limit, $orderBy);

    foreach ($posts as $post) {
        $post_id = $post->id;
        $user = $userRepository->getPostUser($post_id);

        $post->user_id = $user->id;
        $post->user_name = $user->name;
        $post->user_image_profile_url = $user->image_profile_url;
    }

    require('templates/home/homepage.php');
}