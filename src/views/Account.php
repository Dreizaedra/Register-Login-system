
<h1>Page Account</h1>
<h3>Vos informations</h3>
<div> 
    <p>
        <span class="bold">Prénom et nom: </span>
        <?= $_SESSION['full_name']; ?>
    </p>
    <p>
        <span class="bold">E-mail: </span>
        <?= $_SESSION['email']; ?>
    </p>

    <form method="POST" action="<?= SITE . 'verification'; ?>">
        <input type="hidden" name="email-verif" id="email-verif"
            value="<?= $_SESSION['email']; ?>"    
        >
        <button type="submit">Modifier le mot de passe</button>
    </form>
</div>


