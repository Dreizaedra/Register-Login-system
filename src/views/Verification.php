
<h1>Page Vérification</h1>

<?php /**
 * 
 * @var Bool $verified_user
 */
if (isset($_POST['email-verif']) || !$verified_user): ?>
    <form method="POST" action="">
        <div>
            <label for="email">Confirmez votre E-mail :</label><br>
            <input type="email" name="email" id="email" maxlength="50" required
                placeholder="j.dupont@exemple.com"
                value="<?= fetch_value($_POST, 'email-verif'); ?>"
            >

            <?php /**
                * si le message d'erreur existe on l'affiche
                * @var String $email_error
                */
                if (isset($email_error) && $email_error !== null): ?>
                    <div class="error-msg inline">
                        <span class="bold">Erreur: </span>
                        <?= $email_error; ?>
                    </div>
                <?php endif; 
            ?>
        </div>

        <div>
            <button type="submit">Confirmer</button>
        </div>
    </form>
<?php endif; 
 
/**
 * 
 * @var Bool $verified_user
 * @var String $secret_question
 */
if (isset($verified_user) && $verified_user): ?>
    <p><?= $secret_question; ?></p>

    <form method="POST" action="">
        <div>
            <label for="secret-answer">Réponse secrète :</label><br>
            <input type="text" name="secret-answer" id="secret-answer" 
                minlength="2" maxlength="50" required
            >
        </div>
        <button type="submit">Confirmer</button>
    </form>
<?php endif; ?>