<?php

use Model\Tag\TagRepository;
use Model\Post\PostRepository;
use Validator\Post\PostValidator;
use Lib\Post\PostLib;
use Model\User\UserRepository;

require_once base_path('src/model/post.php');
require_once base_path('src/model/user.php');
require_once base_path('src/model/tag.php');
require_once base_path('src/controllers/lib/post.php');
require_once base_path('src/validators/postValidator.php');

$postRepository = new PostRepository();
$userRepository = new UserRepository();
$tagRepository = new TagRepository();
$postValidator = new PostValidator();
$postLib = new PostLib();

if ($uri === "/post") {

    if ($postValidator->idValidator($_GET["id"])) {
        $post_id = $_GET["id"];
    }
    $post = $postRepository->getPost($post_id);
    //get the actual post id from SQL, instead of passing GET user id
    $post_id = $post->id;
    $user = $userRepository->getUserPost($post_id);
    $tags = $tagRepository->getTagsPost($post_id);
    $post->user_name = $user->name;
    $post->user_id = $user->id;
    $post->user_image_profile_url = $user->image_profile_url;
    $post->tags = $tags;

    $postImages = $postRepository->getPostImage($post_id);
    
    if ($method === 'POST') {
        $postValidator->userValidator($_SESSION);
        $images = $postLib->sortFiles($_FILES["image"]);
        $images = $postValidator->imageValidator($images);
        $answer = $postValidator->contentValidator($_POST["answer"]);

        if ($images) {
            $imageDb = $postLib->addImgToServer($_FILES["image"], $_SESSION, "answers_images");
            $postRepository->sendAnswer($_SESSION, $post, $answer, $imageDb);
        }
        else {
            $postRepository->sendAnswer($_SESSION, $post, $answer);
        }
    }

    $answers = $postRepository->getAnswers($post_id);

    echo $twig->render("article/post.php", [
        'post' => $post,
        'postImages' => $postImages,
        'answers' => $answers,
        'page' => 'post',
    ]);
}
else if ($uri === "/post-article") {
    echo $twig->render('article/send_post.php', [
        'page' => 'post',
    ]);
    // page => post is for the sidenav bar
}
else if ($uri === "/submit-post") {
    $images = $postLib->sortFiles($_FILES["image"]);
    $postValidator->userValidator($_SESSION);
    $images = $postValidator->imageValidator($images);
    $title = $postValidator->titleValidator($_POST["title"]);
    $content = $postValidator->contentValidator($_POST["content"]);
    $tags = $postValidator->tagsValidator($_POST["tag"]);

    if($images) {
        $imageDb = $postLib->addImgToServer($_FILES["image"], $_SESSION, "posts_images");
        $postRepository->sendPost($_SESSION, $title, $content, $tags, $imageDb);
    }
    else {
        $postRepository->sendPost($_SESSION, $title, $content, $tags);
    }
    require base_path('src/controllers/homepage.php');
}
