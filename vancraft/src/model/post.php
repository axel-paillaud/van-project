<?php

class Post 
{
    public int $id;
    public string $title;
    public string $creation_date;
    public int $views;
    public int $votes;
    public string $content;
    public string $last_modification;
    public int $answers;
    public int $user_id;
    public string $user_name;
    public string $user_image_profile__url;
    public array $tags;
}

class PostRepository
{
    private ?PDO $database = null;

     public function getPosts(string $limit, string $orderBy) : array {
        $this->dbConnect();
        $statement = $this->database->query(
            "SELECT post_id, title, content, views, votes, answers, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss')
            AS french_creation_date, DATE_FORMAT(last_modification, '%d/%m/%Y à %Hh%imin%ss') AS french_last_modification
            FROM posts ORDER BY votes DESC LIMIT 0, 15"
        );
        $posts = [];
        while (($row = $statement->fetch())) {

            $post = new Post();
            $post->id = $row['post_id'];
            $post->title = $row['title'];
            $post->creation_date = $row['french_creation_date'];
            $post->views = $row['views'];
            $post->votes = $row['votes'];
            $post->answers = $row['answers'];
            $post->content = $row['content'];
            $post->last_modification = $row['french_last_modification'];

            $posts[] = $post;
        }
        return $posts;
    }

    private function dbConnect() {
        try {
            if ($this->database == null) {
                $this->database = new PDO('mysql:host=localhost;dbname=vancraft;charset=utf8', 'axel', 'cRadoc!54');
            }
        } catch(Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
}

require_once('src/model/model.php');

