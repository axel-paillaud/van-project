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
    public string $image_profile_url;
}

class UserRepository
{
    public ?PDO $database = null;

    public function getPostUser(int $post_id) : User {
        $this->dbConnect();

        $statement = $this->database->prepare(
            "SELECT user_id, name FROM users WHERE user_id IN (SELECT user_id FROM posts_users WHERE post_id = ?)"
        );
        $statement->execute([$post_id]);

        $row = $statement->fetch();
        $user = new User();

        $user->id = $row['user_id'];
        $user->name = $row['name'];

        $statement = $this->database->prepare(
            "SELECT image_url_sm FROM images_profiles WHERE user_id = ?;"
        );
        $statement->execute([$user->id]);

        $row = $statement->fetch();
        $user->image_profile_url = $row['image_url_sm'];

        return $user;
    }

    public function subscribeUser($name, $email, $password) {
        $this->dbConnect();

        $statement = $this->database->prepare(
            "INSERT INTO users (user_id, name, email, account_creation_date, password, last_connexion, numbers_of_answers, numbers_of_questions)
            VALUES (NULL, :name, :email, NOW(), :hash_password, NOW(), DEFAULT, DEFAULT)"
        );

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'hash_password' => $password
        ]);
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