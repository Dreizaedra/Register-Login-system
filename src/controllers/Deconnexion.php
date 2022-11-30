<?php

session_destroy();

// supprime les cookies quand l'utilisateur se déco MANUELLEMENT
if (isset($_COOKIE['email'], $_COOKIE['pwd']) && !empty($_COOKIE)) {
    unset($_COOKIE['email'], $_COOKIE['pwd']);
    setcookie(
        'email', 
        null,
        [
            'expires' => time() - 1,
            'secure' => true,
            'httponly' => true,
        ]
    );
    setcookie(
        'pwd', 
        null,
        [
            'expires' => time() - 1,
            'secure' => true,
            'httponly' => true,
        ]
    );
}

// force le retour sur la home page
header('Location: ' . SITE);