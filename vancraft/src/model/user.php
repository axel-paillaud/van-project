<?php

class User
{
    public int $id;
    public string $name;
    public string $email;
    public string $creation_date;
    public string $password;
    public string $last_modification;
    public int $numbers_of_questions;
    public int $numbers_of_answers;
}

class UserRepository
{
    public ?PDO $database = null;

    public function getPostUser(string $post_id) : User {
        $this->dbConnect();

        $statement = $this->database->prepare(
            "SELECT user_id, name FROM users WHERE user_id IN (SELECT user_id FROM posts_users WHERE post_id = ?)"
        );
        $statement->execute([$post_id]);

        $row = $statement->fetch();
        $user = new User();

        $user->id = $row['user_id'];
        $user->name = $row['name'];

        return $user;
    }

    public function dbConnect() {
        try {
            if ($this->database == null) {
                $this->database = new PDO('mysql:host=localhost;dbname=vancraft;charset=utf8', 'shaun', 'cRadoc!54');
            }
        } catch(Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
}