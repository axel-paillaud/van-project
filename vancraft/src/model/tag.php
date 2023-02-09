<?php

class Tag
{
    public int $tag_id;
    public string $title;
    public string $description;
}

class TagRepository
{
    public ?PDO $database = null;

    public function getTagsPost(int $post_id) : array {
        $this->dbConnect();

        $statement = $this->database->prepare(
            "SELECT tag_id, title FROM tags WHERE tag_id IN (
                SELECT tag_id FROM posts_tags WHERE post_id = ?
             )"
        );
        $statement->execute([$post_id]);

        $tags = [];
        while (($row = $statement->fetch())) {

            $tag = new Tag();
            $tag->tag_id = $row['tag_id'];
            $tag->title = $row['title'];

            $tags[] = $tag;
        }

        return $tags;
    }

    public function computeTags(string $tags) : array {
        $tags = trim($tags, ',');
        $tags = strtolower($tags);
        $arr_tags = explode(',', $tags);
        if (count($arr_tags) > 5) {
            throw new Exception("Erreur : Il faut indiquer 5 mots-clefs maximum.");
        }
        foreach ($arr_tags as $tag) {
            trim($tag);
            htmlspecialchars($tag);
        }
        return $arr_tags;
    }

    public function addTags(array $tags) {
        $this->dbConnect();

        $statement = $this->database->query(
            "SELECT title FROM tags"
        );

        $dbTags = $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function dbConnect() {
        try {
            if ($this->database == null) {
                $this->database = new PDO('mysql:host=localhost;dbname=vancraft;charset=utf8', 'axel', 'cRadoc!54');
            }
        } catch(Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
    }
}