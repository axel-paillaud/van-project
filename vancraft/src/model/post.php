<?php

class Post {
    public int $id;
    public string $title;
    public string $frenchCreationDate;
    public int $views;
    public int $votes;
    public string $content;
    public string $imagesUrl;
    public string $frenchLastModification;
}

function getPosts(string $limit, string $orderBy) {
    $database = dbConnect();
    $statement = $database->query(
        "SELECT post_id, title, content, images, views, votes, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss')
        AS french_creation_date, DATE_FORMAT(last_modification, '%d/%m/%Y à %Hh%imin%ss') AS french_last_modification
        FROM posts ORDER BY votes DESC LIMIT 0, 15"
    );
    $post = new Post();
    $posts = [];
    while (($row = $statement->fetch())) {
        $post->id = $row['post_id'];
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['frenchCreationDate'];
        $post->views = $row['views'];
        $post->votes = $row['votes'];
        $post->content = $row['content'];
        $post->imagesUrl = $row['images'];
        $post->frenchLastModification = $row['french_last_modification'];

        $posts[] = $post;
    }
    return $posts;
}

