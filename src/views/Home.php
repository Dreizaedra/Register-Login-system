
<h1>Home Page</h1>
<?php if (isset($_SESSION['full_name']) && !empty($_SESSION['full_name'])): ?>
    <p><?= 'Bonjour ' . $_SESSION['full_name'] . ' !'; ?></p>
<?php endif;
