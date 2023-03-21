<?php

namespace Validator\User;
use Exception;

// if we need database, get pointer to userRepository and use it

class UserValidator {
    public function validateId($id)
    {
        $intId = intval($id);

        if ($intId < 0) {
            throw new Exception("Erreur avec le profil de l'utilisateur : l'id ne peut pas être un nombre négatif");
        }
        else if (is_float($intId)) {
            throw new Exception("Erreur avec le profil de l'utilisateur : l'id ne peut âs être un nombre flottant");
        }
        else {
            return $intId;
        }
    }
}