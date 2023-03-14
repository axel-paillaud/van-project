<?php

namespace Validator\Post;
use Exception;

class PostValidator {
    public function imageValidator($files)
    {
        if ($files[0]->error === 4) {
            return false; //no image is add by user, its not a problem
        }
        else if (count($files) > 4) {
            throw new Exception("Erreur avec le téléversement des fichiers : seul un maximum de 4 images est autorisée");
        }
        for ($i = 0; $i < count($files); $i++)
        {
            if ($files[$i]->error != 0) {
                throw new Exception("Erreur avec le téléversement du fichier sur le serveur, code erreur " . $files[$i]->error);
            }
            else if (strlen($files[$i]->name) > 255) {
                throw new Exception("Erreur avec un fichier image : le nom est trop long");
            }
            else if ($files[$i]->type !== "image/png" && $files[$i]->type !== "image/jpeg" && $files[$i]->type !== "image/gif") {
                throw new Exception("Erreur avec un fichier image : Il n'est pas de type gif/jpeg/png");
            }
            else if ($files[$i]->size > 2000000) {
                throw new Exception("Erreur avec un fichier image : La taille est trop volumineuse ( > à 2mo )");
            }
            else {
                return true;
            }
        }
    }

    public function userValidator($user)
    {
        if (empty($user) || !isset($user)) {
            throw new Exception("Erreur : Vous devez être connecté pour pouvoir poster");
        }
        else {
            return true;
        }
    }

    public function titleValidator($title)
    {
        if (empty($title) || !isset($title)) {
            throw new Exception("Erreur : Le titre est vide");
        }
        else if (strlen($title) > 496) {
            throw new Exception("Erreur : Le titre est trop long");
        }
        else {
            return strip_tags($title);
        }
    }

    public function contentValidator($content)
    {
        if (empty($content) || !isset($content)) {
            throw new Exception("Erreur : Le contenu est vide");
        }
        else {
            return strip_tags($content);
        }
    }

    public function idValidator(mixed $id) : bool
    {
        $id = intval($id, 10);
        if (!is_int($id)) {
            throw new Exception("Erreur : L'id du post n'est pas un nombre");
        }
        else if ($id = 0) {
            throw new Exception("Erreur : un problème est survenu au niveau de l'id du post");
        }
        else if (is_float($id)) {
            throw new Exception("Erreur : L'id du post est un chiffre à virgule");
        }
        else if ($id < 0) {
            throw new Exception("Erreur : L'id du post ne peut pas être un nombre négatif");
        }
        else if ($id > 1000000000) {
            throw new Exception("Erreur : L'id du post ne peut pas être aussi long");
        }
        else {
            return true;
        }
    }

    public function tagsValidator($tags)
    {
        if (empty($tags) || !isset($tags)) {
            throw new Exception("Erreur : Il faut au moins un mot-clef associé à une question");
        }
        else {
            for ($i = 0; $i < count($tags); $i++)
            {
                if (empty($tags[$i])) {
                    array_splice($tags, $i, 1);
                }
                else {
                    $tags[$i] = trim($tags[$i]);
                    $tags[$i] = strtolower($tags[$i]);
                    $tags[$i] = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $tags[$i]); // if string is set to utf-8, preg_replace dont work properly because one char take more than one byte
                    $tags[$i] = preg_replace('/[^A-Za-z0-9\s]/', '', $tags[$i]);
                }
            }
            return $tags;
        }
    }
}