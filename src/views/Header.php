<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php // load les css automatiquement en fonction des pages
    if (isset($singleton['stylesheets'][$url])):
        foreach ($singleton['stylesheets'][$url] as $css): ?>
            <link rel="stylesheet" type="text/css" href="<?= CSS . $css; ?>">
        <?php endforeach;
    endif; ?>

    <title>Register/Login System</title>
</head>
<body>
    <script type="text/javascript" src="<?= JS . 'local_datas.js'; ?>"></script>

    <div id="header">
        <header></header>
        <nav>
            <ul class="flex nav-bar">
                <li>
                    <a class="nav-link link" href="<?= SITE; ?>">Accueil</a>
                </li>

                <?php // si $_SESSION est remplie affiche les boutons 
                      // pour atteindre la page account & pour déco
                if (isset($_SESSION['email'], $_SESSION['pwd'], 
                    $_SESSION['full_name'])): 
                ?>
                    <li>
                        <form method="POST" action="<?= SITE . 'account'; ?>">
                            <button class="nav-link link" type="submit">
                                Mon compte
                            </button>
                        </form>
                    </li>
                    <li>
                        <form method="POST" action="<?= SITE . 'deconnexion'; ?>">
                            <button class="nav-link link" type="submit">
                                Se déconnecter
                            </button>
                        </form>
                    </li>

                <?php // sinon celui pour atteindre la page login ?>
                <?php else: ?>
                    <li>
                        <a class="nav-link link" href="<?= SITE . 'login'; ?>">
                            Login
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>

