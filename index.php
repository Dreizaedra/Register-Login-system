<?php session_start();

require_once 'config.php';
require_once 'DTB.php';

// connexion à la db
$dtb = new DTB();
$pdo = $dtb->DTB_connexion();

// valeurs default
$controller = '404';
$view = '404';
$model = null;
$utils = null;

// routes
$router = [
    '' => [
        'GET' => true,
        'POST' => false,
        'controller' => 'Home',
        'view' => 'Home',
    ],
    'login' => [
        'GET' => true,
        'POST' => true,
        'controller' => 'Login',
        'view' => 'Login',
        'model' => 'User',
        'utils' => ['functions'],
    ],
    'register' => [
        'GET' => true,
        'POST' => true,
        'controller' => 'Register',
        'view' => 'Register',
        'model' => 'User',
        'utils' => ['variables', 'functions'],
    ],
    'account' => [
        'GET' => false,
        'POST' => true,
        'controller' => 'Account',
        'view' => 'Account',
    ],
    'verification' => [
        'GET' => false,
        'POST' => true,
        'controller' => 'Verification',
        'view' => 'Verification',
        'model' => 'User',
        'utils' => ['variables', 'functions'],
    ],
    'modify_pwd' => [
        'GET' => true,
        'POST' => true,
        'controller' => 'Modify_pwd',
        'view' => 'Modify_pwd',
        'model' => 'User',
        'utils' => ['functions'],
    ],
    'deconnexion' => [
        'GET' => false,
        'POST' => true,
        'controller' => 'Deconnexion',
    ],
    'ajax' => [
        'GET' => true,
        'POST' => false,
        'controller' => 'Ajax',
    ],
];

// retire la partie des urls qui nous intéresse pas (PATH)
$url = str_replace(PATH, '', $_SERVER['REQUEST_URI']);

// pour les changement de pages & vérification de la méthode (get ou post)
if (isset($url, $router[$url]) && $router[$url][$_SERVER['REQUEST_METHOD']]) {
    $controller = $router[$url]['controller'];
    if (isset($router[$url]['view'])) {
        $view = $router[$url]['view'];
    }
    if (isset($router[$url]['model'])) {
        $model = $router[$url]['model'];
    }
    if (isset($router[$url]['utils'])) {
        $utils = $router[$url]['utils'];
    }
};

// load les models, utils, controllers & view (voir views/Base.php pour $view)
if ($model !== null) {
    require_once 'src/models/' . $model . '.php';
}
if ($utils !== null) {
    foreach ($utils as $util) {
        require_once 'src/utils/' . $util . '.php';
    }
}
require_once 'src/controllers/' . $controller . '.php';
require_once 'src/views/Base.php';