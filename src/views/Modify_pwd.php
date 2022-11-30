
<h1>Page modification de mot de passe</h1>

<?php if (!$modified_pwd): ?>
    <form method="POST" action="">
        <!-- Mot de passe -->
        <div> 
            <label class="bold" for="pwd">Nouveau Mot de passe:</label>
                
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

        <!-- Confirmation du mot de passe -->
        <div> 
            <label class="bold" for="confirm">
                Confirmez votre nouveau mot de passe:
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

        <button type="submit">Confirmer le changement</button>
    </form>
<?php else: ?>
    <p>
        Mot de passe modifié avec succès !<br>
        Vous allez être redirigé dans 5 secondes...<br>
        Sinon <a href="<?= SITE . 'login'; ?>">Cliquez ici</a>
    </p>
<?php endif; ?>

<script>
    local_datas.urls.ajax = "<?= SITE . 'ajax'; ?>";
</script>