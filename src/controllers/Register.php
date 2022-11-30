<?php
$registered_user = false; 

if (!empty($_POST)) {
    // rassemble le nom & pose les variables 
    // strip les potentiels tags html
    $full_name = 
        strip_tags(ucfirst($_POST['fname'])) . ' ' . 
        strip_tags(ucfirst($_POST['lname']))
    ;
    $email = strip_tags($_POST['email']) ?? null;
    $pwd = strip_tags($_POST['pwd']) ?? null;
    $confirm = strip_tags($_POST['confirm']) ?? null;

    $secret_question = $_POST['secret-question'];
    $secret_answer = trim(strip_tags($_POST['secret-answer'])) ?? null;

    // vérifie que les input ne sont pas null et pas trop longs
    if (
        $email !== null && $pwd !== null && $secret_answer !== null 
        && strlen($full_name) <= 50
        && strlen($email) <= 50 && strlen($pwd) <= 20 
        && strlen($secret_question) === 1 && strlen($secret_answer) <= 50 
    ) { 
        // vérifie que $confirm et $pwd ont la même valeur
        if ($confirm !== null && $pwd === $confirm && strlen($confirm) <= 20) {
            // reset le message d'erreur si il n'était pas vide 
            // suite à un input précédent incorrect
            $confirm_error = null; 

            /** 
             * ajoute le nouvel utilisateur à la db
             * qui retourne un potentiel message d'erreur
             * @var PDO $pdo 
             */
            $users = new User();
            $email_error = $users->add_user(
                $pdo, $full_name, $email, $pwd, $secret_question, $secret_answer
            );

            // si le message d'erreur est vide 
            // passe le bool en true pour changer la view
            // et redirige vers la page login dans 5s
            if ($email_error === null) {
                $registered_user = true;
                header('Refresh: 5; URL= ' . SITE . 'login');
            }

        // si l'input de confirmation est null
        // ou si il ne correspond pas au password créé un message d'erreur 
        // ou si les inputs sont trop longs
        } else { 
            $confirm_error = 'Le mot de passe ne correspond pas';
        }
    }
}