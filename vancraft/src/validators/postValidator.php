<?php

namespace Validator\Post;
use Exception;

class postValidator {
    public function imageValidator($files) {
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

    public function userValidator($user) {
        if (empty($user) || !isset($user)) {
            throw new Exception("Erreur : Vous devez être connecté pour pouvoir poster une question");
        }
        else {
            return true;
        }
    }
}