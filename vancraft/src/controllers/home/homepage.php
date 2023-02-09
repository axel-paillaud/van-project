<?php

require_once base_path('src/model/post.php');
require_once base_path('src/model/user.php');
require_once base_path('src/model/tag.php');

function homepage() {
    $limit = "LIMIT 0, 15";
    $orderBy = "votes";
    //for the moment, the variable limit and orderBy aren't used in model/post.php

    $postRepository = new PostRepository();
    $userRepository = new UserRepository();
    $tagRepository = new TagRepository();

    $posts = $postRepository->getPosts($limit, $orderBy);

    //get user and tag from post
    foreach ($posts as $post) {
        $post_id = $post->id;
        $user = $userRepository->getPostUser($post_id);
        $tags = $tagRepository->getTagsPost($post_id);

        $post->user_id = $user->id;
        $post->user_name = $user->name;
        $post->user_image_profile_url = $user->image_profile_url;
        $post->tags = $tags;
    }

    return $posts;
}

if (!isset($message)) {
    $message = "";
}

if (!isset($bad_message)) {
    $bad_message = false;
}

$posts = homepage();

echo $twig->render('home/homepage.php', [
    'posts' => $posts,
    'message' => $message,
    'bad_message' => $bad_message,
    'page' => 'home',
]);
