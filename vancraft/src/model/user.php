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
            "SELECT image_url_sm FROM images_profiles WHERE user_id = ?"
        );
        $statement->execute([$user->id]);

        $row = $statement->fetch();
        $user->image_profile_url = $row['image_url_sm'];

        return $user;
    }

    public function subscribeUser(string $name, string $email, string $hash_password,string $password, string $confirm_password) : bool {
        $this->dbConnect();

        if (empty($name) || empty($email) || empty($password))
            throw new Exception("Erreur : Un des champs d'inscription est vide.");

        if ($password !== $confirm_password)
            throw new Exception("Erreur : Les deux mots de passe ne correspondent pas.");

        $name_len = strlen($name);
        $email_len = strlen($email);

        if ($name_len > 47)
            throw new Exception('Erreur : Le prénom doit contenir moins de 48 caractères.');

        if ($email_len > 254)
            throw new Exception("Erreur : L'adresse mail doit contenir moins de 255 caractères.");

        if ($name_len < 3)
            throw new Exception("Erreur : Le prénom doit contenir plus de 2 caractères.");

        $statement = $this->database->prepare(
            "INSERT INTO users (user_id, name, email, account_creation_date, password, last_connexion, numbers_of_answers, numbers_of_questions)
            VALUES (NULL, :name, :email, NOW(), :hash_password, NOW(), DEFAULT, DEFAULT)"
        );

        $statement->execute([
            'name' => $name,
            'email' => $email,
            'hash_password' => $hash_password
        ]);

        return true;
    }

    public function checkIfExist(string $name, string $email) : array {
        $this->dbConnect();

        $check = [
            'name_check' => false,
            'email_check' => false,
            'name_and_email_check' => false
        ];

        $statement = $this->database->prepare(
            "SELECT name FROM users WHERE name = ?"
        );

        $statement->execute([$name]);
        $name_row = $statement->fetch();

        $statement = $this->database->prepare(
            "SELECT email FROM users WHERE email = ?"
        );

        $statement->execute([$email]);
        $email_row = $statement->fetch();

        $statement = $this->database->prepare(
            "SELECT email, name FROM users WHERE email = :email AND name = :name"
        );

        $statement->execute(['email'=>$email, 'name'=>$name]);
        $name_and_email_row = $statement->fetch();

        if(empty($name_row) && empty($email_row))
            return $check;
        elseif (!empty($name_and_email_row)) {
            $check['name_and_email_check'] = true;
            return $check;
        }
        return $check;
    }
    
    public function dbConnect() {
        if ($this->database == null) {
            $this->database = new PDO('mysql:host=localhost;dbname=vancraft;charset=utf8', 'shaun', 'cRadoc!54');
        }
    }
}