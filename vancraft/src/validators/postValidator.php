<?php

namespace Validator\Post;
use Exception;

class postValidator {
    public function imageValidator($files) {
        for ($i = 0; $i < count($files); $i++)
        {
            if ($files[$i]->error === 4) {
                return false; //no image is add by user, its not a problem
            }
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

    public function userValidator($user) {
        if (empty($user) || !isset($user)) {
            throw new Exception("Erreur : Vous devez être connecté pour pouvoir poster une question");
        }
        else {
            return true;
        }
    }

    public function titleValidator($title) {
        if (empty($title) || !isset($title)) {
            throw new Exception("Erreur : Le titre est vide");
        }
        else if (strlen($title) > 496) {
            throw new Exception("Erreur : Le titre est trop long");
        }
        else {
            return htmlspecialchars($title, ENT_QUOTES);
        }
    }

    public function contentValidator($content) {
        if (empty($content) || !isset($content)) {
            throw new Exception("Erreur : Le contenu est vide");
        }
        else {
            return htmlspecialchars($content, ENT_QUOTES);
        }
    }

    public function tagsValidator($tags) {
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
                    $tags[$i] = strtolower($tags[$i]);
                    echo ($tags[$i]);
                    $tags[$i] = strtr($tags[$i], 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ', 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn');
                    echo ($tags[$i]);
                    $tags[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $tags[$i]);
                }
            }
            dd($tags);
        }
    }
}