<?php

class User {

    /**
     * ajoute un nouvel utilisateur à la db
     * et return un potentiel message d'erreur
     * @param PDO $pdo
     * @param String $full_name
     * @param String $email
     * @param String $pwd
     * @param Int $secret_question
     * @param String $secret_answer
     * @return null|String
     */
    public function add_user(
        PDO $pdo, 
        String $full_name, 
        String $email, 
        String $pwd, 
        Int $secret_question, 
        String $secret_answer
    ) {
        $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $hash_answer = hash('sha256', $secret_answer, false);

        $query = $pdo->prepare(
            "INSERT INTO `users` 
            (`user_id`, `full_name`, `email`, `pwd`, 
            `secret_question`, `secret_answer`, `is_enabled`) 
            VALUES (NULL, :full_name, :email, :pwd, :question, :answer, '1')"
        );
        $query->bindParam(':full_name', $full_name, PDO::PARAM_STR, 50);
        $query->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $query->bindParam(':pwd', $hash_pwd, PDO::PARAM_STR, 256);
        $query->bindParam(':question', $secret_question, PDO::PARAM_INT, 1);
        $query->bindParam(':answer', $hash_answer, PDO::PARAM_STR, 256);
        $query->execute();

        if ($query->rowCount() > 0) {
            return null;
        }
        return 'E-mail déjà enregistré';
    }

    /**
     * return les données en db d'un utilisateur déjà inscrit
     * @param PDO $pdo
     * @param String $email
     * @param String $pwd
     * @return Object|null
     */
    public function get_user(PDO $pdo, String $email, String $pwd) 
    {
        $query = $pdo->prepare(
            "SELECT full_name, email, pwd FROM `users` 
            WHERE email = :email AND is_enabled = '1'"
        );
        $query->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $query->execute();

        if ($query->rowCount() > 0) {
            $user = $query->fetchObject();

            if ($pwd === $user->pwd || password_verify($pwd, $user->pwd)) {
                return $user;
            }
        }

        return null;
    }

    /**
     * cherche la question secrète et sa réponse dans la db si l'email existe
     * sinon return null
     * || call si l'user cherche à modifier son password
     * @param PDO $pdo
     * @param String $email
     * @return Object|null
     */
    public function verif_user(PDO $pdo, String $email) 
    {
        $query = $pdo->prepare(
            "SELECT user_id, secret_question, secret_answer FROM `users` 
            WHERE email = :email AND is_enabled = '1'"
        );
        $query->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $query->execute();

        if ($query->rowCount() > 0) {
            return $query->fetchObject();
        }
        return null;
    }

    /**
     * modifie le password en db d'un utilisateur déjà inscrit
     * et return son hash si ça a fonctionné (pour le cookie éventuel)
     * @param PDO $pdo
     * @param Int $user_id
     * @param String $new_pwd
     * @return String|null
     */
    public function edit_user(PDO $pdo, Int $user_id, String $new_pwd) 
    {
        $hash_pwd = password_hash($new_pwd, PASSWORD_DEFAULT);

        $query = $pdo->prepare(
            "UPDATE `users` SET `pwd` = :pwd WHERE `users`.`user_id` = :user_id"
        );
        $query->bindParam(':user_id', $user_id, PDO::PARAM_INT, 11);
        $query->bindParam(':pwd', $hash_pwd, PDO::PARAM_STR, 256);
        $query->execute();

        // on return le pwd hash si la requete SQL a réussi
        if ($query->rowCount() > 0) {
            return $hash_pwd;
        }
        // sinon on return null
        return null;
    }
}

