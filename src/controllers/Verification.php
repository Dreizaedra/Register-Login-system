<?php
$verified_user = false;

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = strip_tags($_POST['email']) ?? null;

    if ($email !== null) {
        /** @var PDO $pdo */
        $users = new User();
        $verif = $users->verif_user($pdo, $email);

        if (isset($verif) && $verif !== null) {
            $email_error = null;
            /** @var Array $secret_questions */
            $secret_question = 
                fetch_value($secret_questions, $verif->secret_question)
            ;

            if ($secret_question !== null) {
                $redirect_user = false;
                $verified_user = true;
                create_session([
                    'user_id' => $verif->user_id,
                    'secret_question' => $verif->secret_question,
                    'secret_answer' => $verif->secret_answer
                ]);
            }
        } else {
            $email_error = 'Email incorrect';
        }
    }
}

// vérifie si la réponse correspond
if (isset($_POST['secret-answer'])) {
    $secret_answer = trim(strip_tags($_POST['secret-answer'])) ?? null;

    if ($secret_answer !== null) {
        $hash_answer = hash('sha256', $secret_answer, false);

        if ($hash_answer === $_SESSION['secret_answer']) {
            unset($_SESSION['secret_question'], $_SESSION['secret_answer']);
            header('Location: ' . SITE . 'modify_pwd');

        } else {
            // réponse incorrecte
        }  
    }
}
