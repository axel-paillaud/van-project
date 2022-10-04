<?php

function dbConnect() {
    try {
        $database = new PDO('mysql:host=localhost;dbname=vancraft;charset=utf8', 'shaun', 'cRadoc!54');
        return $database;
    } catch(Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
}