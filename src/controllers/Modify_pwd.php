<?php

// redirige et tue le script si l'user arrive là via l'url (en trichant quoi)
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header('Location: ' . SITE);
    die();
}

$modified_pwd = false;

if (isset($_POST['pwd'], $_POST['confirm'])) {
    $pwd = strip_tags($_POST['pwd']) ?? null;
    $confirm = strip_tags($_POST['confirm']) ?? null;

    // vérifie les valeurs et leur longueur
    if (strlen($pwd) <= 20 && strlen($confirm) <= 20) {
        if ($pwd !== null && $confirm !== null && $pwd === $confirm) {
            // reset le message d'erreur si il existait
            $confirm_error = null;

            /** @var PDO $pdo */
            $user = new User();
            $hash_pwd = $user->edit_user($pdo, $_SESSION['user_id'], $pwd);

            // si la requete SQL a réussi on passe le bool en true
            // on unset la supervariable user_id (plus besoin)
            if (isset($hash_pwd) && $hash_pwd !== null) {
                $modified_pwd = true;
                unset($_SESSION['user_id']);

                // on change le pwd dans le cookie si il existe
                if (isset($_COOKIE['pwd'])) {
                    unset($_COOKIE['pwd']);
                    setcookie(
                        'pwd',
                        $hash_pwd,
                        [
                            'expires' => time() + 24*3600,
                            'secure' => true,
                            'httponly' => true,
                        ]
                    );
                }

                // on change le pwd en session si il existe
                if (isset($_SESSION['pwd'])) {
                    unset($_SESSION['pwd']);
                    create_session(['pwd' => $hash_pwd]);
                }

                // on redirige après 5s
                header('Refresh: 5; URL= ' . SITE);
            }

        } else { // si $pwd et $confirm ne correspondent pas
            $confirm_error = 'Le mot de passe ne correspond pas';
        }

    } else { // si $pwd et ou $confirm sont trop longs
        $confirm_error = 'Mot de passe trop long';
    }     
}