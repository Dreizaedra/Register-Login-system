<?php

class DTB {
    // connexion à la db
    public function DTB_connexion() {
        try {
            $pdo = new PDO(
                'mysql:host=localhost;dbname=tests_site;charset=utf8', 
                'root', 
                ''
            );
            return $pdo;
        } catch (Exception $e) {
            die ('Erreur : ' . $e->getMessage());
        };
    }
}