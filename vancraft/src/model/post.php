<?php

namespace Model\Post;
use PDO;
use Exception;

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

    public function sendPost(array $user, string $title, string $content, array $tags, mixed $imageDb = false) {
        $this->dbConnect();

        $statement = $this->database->prepare(
            "INSERT INTO posts (title, creation_date, views, votes, content, last_modification, answers)
            VALUE (:title, NOW(), DEFAULT, DEFAULT, :content, NOW(), DEFAULT)"
        );

        $statement->execute([
            'title' => $title,
            'content' => $content,
        ]);

        $postId = $this->database->lastInsertId();

        $statement = $this->database->prepare(
            "INSERT INTO posts_users(post_id, user_id)
            VALUE(:post_id, :user_id)"
        );

        $statement->execute([
            'post_id' => $postId,
            'user_id' => $user["user_id"],
        ]);

        if ($imageDb !== false) {
            for ($i = 0; $i < count($imageDb); $i++)
            {
                $statement = $this->database->prepare(
                    "INSERT INTO images_posts (post_id, name, image_url)
                    VALUE(:post_id, :name, :image_url)"
                );
    
                $statement->execute([
                    'post_id' => $postId,
                    'name' => $imageDb[$i]->name,
                    'image_url' => $imageDb[$i]->imgUrl,
                ]);
            }
        }

        for ($i = 0; $i < count($tags); $i++)
        {
            // first check if tag already exist in the table. if no, add it, if yes, get his id
            $statement = $this->database->prepare(
                "SELECT tag_id FROM tags WHERE title = :tag"
            );
            $statement->execute([
                'tag' =>$tags[$i],
            ]);
            $tagAlreadyExist = $statement->fetchColumn();
            print_r($tagAlreadyExist);

            if (empty($tagAlreadyExist)) {
                $statement = $this->database->prepare(
                    "INSERT INTO tags (title)
                    VALUE (:tag)"
                );
    
                $statement->execute([
                    'tag' => $tags[$i],
                ]);

                $tagId = $this->database->lastInsertId();

                $statement = $this->database->prepare(
                    "INSERT INTO posts_tags (post_id, tag_id) VALUE (:post_id, :tag_id)"
                );
                $statement->execute([
                    'post_id' => $postId,
                    'tag_id' => $tagId,
                ]);
            }
            else {
                $statement = $this->database->prepare(
                    "INSERT INTO posts_tags (post_id, tag_id) VALUE (:post_id, :tag_id)"
                );
                $statement->execute([
                    'post_id' => $postId,
                    'tag_id' => $tagAlreadyExist,
                ]);
            }
        }
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
