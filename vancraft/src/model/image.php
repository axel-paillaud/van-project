<?php
namespace Model\Image;
use Exception;
use PDO;


class ImageRepository
{
    private ?PDO $database = null;

    public function sendImagePost($urlImg, $nameImg, $postId) {
        echo "hello, sendImagePost here";
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