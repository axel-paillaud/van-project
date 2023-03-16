<?php

namespace Model\Post;
use PDO;
use Exception;
use Model\User\UserRepository;

class Post 
{
    public int $id;
    public string $title;
    public string $creation_date;
    public string $french_creation_date;
    public int $views;
    public int $votes;
    public string $content;
    public string $last_modification;
    public string $french_last_modification;
    public int $answers;
    public int $user_id;
    public string $user_name;
    public string $user_image_profile_url;
    public array $tags;
}

class Answer
{
    public int $id;
    public string $content;
    public string $creation_date;
    public string $french_creation_date;
    public string $last_modification;
    public string $french_last_modification;
    public int $votes;
    public int $user_id;
    public string $user_name;
    public string $user_image_profile_url;
    public array|bool $images;
}

class PostImage
{
    public int $id;
    public int $post_id;
    public string $name;
    public string $url;
}

class PostRepository
{
    private ?PDO $database = null;

    // get one post with ID
    public function getPost(int $id) : Post
    {
        $this->dbConnect();
        // get post
        $statement = $this->database->prepare(
            "SELECT *, DATE_FORMAT(creation_date, '%d/%m/%Y à %H h %i min')
            AS french_creation_date, DATE_FORMAT(last_modification, '%d/%m/%Y à %H h %i min') AS french_last_modification
            FROM posts WHERE post_id = ?;"
        );
        $statement->execute([$id]);
        $row = $statement->fetch();
        
        $post = new Post();

        $post->id = $row['post_id'];
        $post->title = $row['title'];
        $post->french_creation_date = $row['french_creation_date'];
        $post->views = $row['views'];
        $post->votes = $row['votes'];
        $post->content = $row['content'];
        $post->french_last_modification = $row['french_last_modification'];
        $post->answers = $row['answers'];

        return $post;
    }

    public function getPostImage(int $id) : bool|array
    {
        $this->dbConnect();
        $statement = $this->database->prepare(
            "SELECT * FROM images_posts WHERE post_id = ?"
        );
        $statement->execute([$id]);
        
        $images = [];
        while (($row = $statement->fetch())) {
            $image = new PostImage();
            $image->id = $row['image_id'];
            $image->post_id = $row['post_id'];
            $image->name = $row['name'];
            $image->url = $row['image_url'];

            $images[] = $image;
        }

        if (empty($images)) {
            return false;
        }
        else {
            return $images;
        }
    }

    public function getAnswerImage(int $answerId) : bool|array
    {
        $this->dbConnect();
        $statement = $this->database->prepare(
            "SELECT * FROM images_answers WHERE answer_id = ?"
        );
        $statement->execute([$answerId]);
        
        $images = [];
        while (($row = $statement->fetch())) {
            $image = new PostImage();
            $image->id = $row['image_id'];
            $image->post_id = $row['answer_id'];
            $image->name = $row['name'];
            $image->url = $row['image_url'];

            $images[] = $image;
        }

        if (empty($images)) {
            return false;
        }
        else {
            return $images;
        }
    }

    // get all posts for homepage
    public function getPosts(string $limit, string $orderBy) : array
    {
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
            $post->french_creation_date = $row['french_creation_date'];
            $post->views = $row['views'];
            $post->votes = $row['votes'];
            $post->answers = $row['answers'];
            $post->content = $row['content'];
            $post->french_last_modification = $row['french_last_modification'];

            $posts[] = $post;
        }
        return $posts;
    }

    //get all answers from posts;
    public function getAnswers(int $post_id) : array|bool
    {
        $this->dbConnect();
        $statement = $this->database->prepare(
            "SELECT answer_id FROM answers_posts WHERE post_id = ?"
        );
        $statement->execute([$post_id]);

        $answers = [];
        while (($row = $statement->fetch())) {

            $answer = new Answer();
            $answer->id = $row['answer_id'];
            $answers[] = $answer;
        }

        if (count($answers) === 0) {
            return false;
        }

        // for each answers id, get full answers, user, and images
        foreach ($answers as $answer) {
            // get full answers
            $statement = $this->database->prepare(
                "SELECT content, DATE_FORMAT(answer_creation_date, '%d/%m/%Y à %H h %i min')
                AS french_creation_date, votes, 
                DATE_FORMAT(last_modification, '%d/%m/%Y à %H h %i min') AS french_last_modification
                FROM answers WHERE answer_id = ?"
            );
            $statement->execute([$answer->id]);
            $row = $statement->fetch();

            $answer->content = $row['content'];
            $answer->french_creation_date = $row['french_creation_date'];
            $answer->french_last_modification = $row['french_last_modification'];
            $answer->votes = $row['votes'];

            // get user
            $statement = $this->database->prepare(
                "SELECT user_id FROM users_answers WHERE answer_id = ?"
            );
            $statement->execute([$answer->id]);
            $row = $statement->fetch();
            $answer->user_id = $row['user_id'];

            $userRepository = new UserRepository();
            $user = $userRepository->getUser($answer->user_id);
            $answer->user_name = $user->name;
            $answer->user_image_profile_url = $user->image_profile_url;

            // get answer images
            $images = $this->getAnswerImage($answer->id);
            if($images) {
                $answer->images = $images;
            }
            else {
                $answer->images = false;
            }
        }
        return $answers;
    }

    public function sendPost(array $user, string $title, string $content, array $tags, $imageDb = null)
    {
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

        // send images
        if ($imageDb !== null) {
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

        // send tags
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

        // increment total number of posts of users table
        $userRepository = new UserRepository();
        $userRepository->incrementUserPost($user["user_id"]);
    }

    public function sendAnswer(array $user, Post $post, string $answer, $imageDb = null)
    {
        $this->dbConnect();

        $statement = $this->database->prepare(
            "INSERT INTO answers (content, answer_creation_date, votes, last_modification)
            VALUE (:content, NOW(), DEFAULT, NOW())"
        );
        $statement->execute([
            'content' => $answer,
        ]);

        $answerId = $this->database->lastInsertId();

        $statement = $this->database->prepare(
            "INSERT INTO users_answers(user_id, answer_id)
            VALUE(:user_id, :answer_id)"
        );
        $statement->execute([
            'user_id' => $user["user_id"],
            'answer_id' => $answerId,
        ]);

        $statement = $this->database->prepare(
            "INSERT INTO answers_posts(post_id, answer_id)
            VALUE(:post_id, :answer_id)"
        );
        $statement->execute([
            'post_id' => $post->id,
            'answer_id' =>$answerId,
        ]);

        if ($imageDb !== null) {
            for ($i = 0; $i < count($imageDb); $i++)
            {
                $statement = $this->database->prepare(
                    "INSERT INTO images_answers (answer_id, name, image_url)
                    VALUE(:answer_id, :name, :image_url)"
                );
    
                $statement->execute([
                    'answer_id' => $answerId,
                    'name' => $imageDb[$i]->name,
                    'image_url' => $imageDb[$i]->imgUrl,
                ]);
            }
        }

        // add one to the total number of answers in posts table
        $statement = $this->database->prepare(
            "UPDATE posts SET posts.answers = posts.answers + 1 WHERE post_id = ?"
        );
        $statement->execute([$post->id]);

        // add one to the total of answers in users table
        $userRepository = new UserRepository();
        $userRepository->incrementUserAnswer($user["user_id"]);
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
