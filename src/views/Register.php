
<h1>Page Register</h1>
<?php

/** 
 * si l'utilisateur n'est pas enregistré affiche le formulaire
 * @var boolean $registered_user 
 */
if (!$registered_user): ?>

    <form method="POST" action="">
        <!-- Nom -->
        <div> 
            <label class="bold" for="lname">Nom:</label><br>
            <input type="text" name="lname" id="lname" 
                placeholder="Dupont" maxlength="50" 
                value="<?= fetch_value($_POST, 'lname'); ?>" required
            >
        </div>

        <!-- Prénom -->
        <div>
            <label class="bold" for="fname">Prénom:</label><br>
            <input type="text" name="fname" id="fname" 
                placeholder="Jean" maxlength="50" 
                value="<?= fetch_value($_POST, 'fname'); ?>" required
            >
        </div>

        <!-- Email -->
        <div> 
            <label class="bold" for="email">E-mail:</label><br>
            <input type="email" name="email" id="email" 
                placeholder="j.dupont@exemple.com" maxlength="50" 
                value="<?= fetch_value($_POST, 'email'); ?>" required
            >

            <?php 
                /** 
                 * si l'email est déjà enregistré affiche une erreur
                 * @var string $email_error 
                 */
                if (isset($email_error) && $email_error !== null): ?>
                    <div class="error-msg inline">
                        <span class="bold">Erreur: </span><?= $email_error; ?>
                    </div>
                <?php endif; 
            ?>
        </div>

        <!-- Mot de passe -->
        <div> 
            <label class="bold" for="pwd">Mot de passe:</label>
            
            <input class="show-checkbox" type="checkbox" id="pwd-cb">
            <div class="inline italic" id="pwd-cb-help">Hidden</div><br>

            <input type="password" name="pwd" id="pwd" 
                minlength="8" maxlength="20" 
                value="<?= fetch_value($_POST, 'pwd'); ?>" required
            >

            <div class="inline">
                <button type="button" onclick="generate_pwd()">
                    Générer un mot de passe aléatoire
                </button>
            </div>
            <div class="italic" id="pwd-help">
                8 caractères minimum, 20 maximum
            </div>
        </div>

        <!-- Confirmation de mot de passe -->          
        <div> 
            <label class="bold" for="confirm">
                Confirmez votre mot de passe:
            </label>

            <input class="show-checkbox" type="checkbox" id="confirm-cb">
            <div class="inline italic" id="confirm-cb-help">Hidden</div><br>

            <input type="password" name="confirm" id="confirm" required>

            <?php 
                /** 
                 * si la confirmation ne correspond pas affiche une erreur
                 * @var string $confirm_error 
                 */
                if (isset($confirm_error) && $confirm_error !== null): ?>
                    <div class="error-msg inline">
                        <span class="bold">Erreur: </span><?= $confirm_error; ?>
                    </div>
                <?php endif;
            ?>
        </div>

        <!-- Question secrète -->
        <div>
            <label class="bold" for="secret-question">
                Question secrète:
            </label><br>

            <select name="secret-question" id="secret-question" required>
                <option value="">
                    --- Choisissez une question secrète ---
                </option>

                <?php /**
                 * ajoute les options pour chaque question existante
                 * @var Array $secret_questions
                 */
                foreach ($secret_questions as $key => $question): ?>
                    <option value="<?= $key; ?>">
                        <?= $question; ?>
                    </option>
                <?php endforeach; ?>

            </select>
        </div>

        <!-- Réponse secrète -->
        <div>
            <label class="bold" for="secret-answer">
                Réponse secrète:
            </label><br>

            <input type="text" name="secret-answer" id="secret-answer" 
                minlength="2" maxlength="50" required
            >
        </div>

        <hr>
        <button type="submit">Créer mon compte</button>
    </form>

      

<?php else: // sinon affiche le message de confirmation et 
            // le link pour rediriger vers login ?>
    <p>
        Votre inscription a bien été prise en compte.<br>
        Vous allez être redirigé dans 5s...<br>
        Sinon <a class="link" href="<?= SITE . 'login'; ?>">Cliquez ici</a>
    </p>
<?php endif; ?>


<script>
    local_datas.urls.ajax = "<?= SITE . 'ajax'; ?>";
</script>