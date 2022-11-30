
<h1>Page Login</h1>
<?php 

/** @var string $login_error */
if (isset($login_error) && $login_error !== null): ?>
    <p class="error-msg">
        <span class="bold">Erreur: </span>
        <?= $login_error; ?>
    </p>
<?php endif; ?>

<?php 

/** 
 * si l'utilisateur n'est pas log affiche le formulaire
 * et le lien vers la page register
 * @var boolean $logged_user 
 */
if (!$logged_user): ?>
    <!-- Formulaire de connexion -->
    <form method="POST" action="">

        <!-- E-mail -->
        <div>
            <label class="bold" for="email">E-mail:</label><br>
            <input type="email" name="email" id="email" 
                placeholder="you@example.com" maxlength="50" 
                value="<?= fetch_value($_POST, 'email'); ?>" required
            >
        </div>

        <!-- Mot de passe -->
        <div>
            <label class="bold" for="pwd">Mot de passe:</label>

            <input class="show_checkbox" type="checkbox" id="pwd-cb">
            <div class="inline italic" id="pwd-cb-help">Hidden</div><br>

            <input type="password" name="pwd" id="pwd" maxlength="20" required>
        </div>
        
        <button type="submit">Se connecter</button>
    </form>

    <!-- Lien vers la page vérification pour modifier le pwd si oublié -->
    <form method="POST" action="<?= SITE . 'verification'; ?>">
        <input type="hidden" name="email-verif" id="email-verif" maxlength="50"
            value="<?= fetch_value($_POST, 'email'); ?>"
        >
        <button class="link" type="submit">Mot de passe oublié ?</button>
    </form>

    <hr>
    <!-- Message & lien pour créer son compte -->
    <p>
        Pas encore de compte ?<br>
        <a class="link" href="<?= SITE . 'register'; ?>">Cliquez ici</a>
        pour en créer un !
    </p>

<?php // sinon affiche un message
else: ?>
    <p>Connecté en tant que <?= $_SESSION['full_name']; ?></p>
<?php endif; ?>

