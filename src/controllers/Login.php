<?php
$logged_user = false;

// si les cookies existent et ne sont pas vides
if (isset($_COOKIE['email'], $_COOKIE['pwd']) && !empty($_COOKIE)) {
    $email = strip_tags($_COOKIE['email']) ?? null;
    $pwd = strip_tags($_COOKIE['pwd']) ?? null;

    // si ils ne sont pas null on va les chercher dans la db
    if ($email !== null && $pwd !== null) {
        /** @var PDO $pdo */
        $users = new User();
        $user = $users->get_user($pdo, $email, $pwd);

        // si ils correspondent aux données dans la db 
        // log l'utilisateur & bascule en session
        if (isset($user) && $user !== null) {
            create_session([
                'full_name' => $user->full_name,
                'email' => $user->email,
                'pwd' => $user->pwd,
            ]);
            $logged_user = true;
        }
    }
}

// si le post n'est pas vide pose les variables
// strip les potentiels tags html au passage
if (!empty($_POST)) {
    $email = strip_tags($_POST['email']) ?? null;
    $pwd = strip_tags($_POST['pwd']) ?? null;

    // si les id ne sont pas null on va les chercher dans la db
    if (
        $email !== null && $pwd !== null 
        && strlen($email) <= 50 && strlen($pwd) <= 20
    ) {
        /** @var PDO $pdo */
        $users = new User();
        $user = $users->get_user($pdo, $email, $pwd);

        // si les id existent dans la db & vide le message d'erreur
        // si il était rempli suite à un login incorrect précédent
        if (isset($user) && $user !== null) {
            $login_error = null;

            // si les cookies n'existent pas ou sont vides on les set
            if (!isset($_COOKIE['email'], $_COOKIE['pwd']) || empty($_COOKIE)) {
                setcookie(
                    'email',
                    $user->email,
                    [
                        'expires' => time() + 24*3600,
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
                setcookie(
                    'pwd',
                    $user->pwd,
                    [
                        'expires' => time() + 24*3600,
                        'secure' => true,
                        'httponly' => true,
                    ]
                );
            }
            
            // log l'utilisateur & bascule en session
            create_session([
                'full_name' => $user->full_name,
                'email' => $user->email,
                'pwd' => $user->pwd,
            ]);
            $logged_user = true;

        // si les id existent pas dans la db créé le message d'erreur    
        } else {
            $login_error = 'Login incorrect';
        }
    } else {
        $login_error = 'Login incorrect';
    }
}

