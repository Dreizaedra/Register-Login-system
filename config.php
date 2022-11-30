<?php

    // variables de navigation
    const SITE = 'http://localhost/tests_site/N3/';
    const PATH = '/tests_site/N3/';
    const CSS = 'http://localhost/tests_site/N3/web/css/';
    const JS = 'http://localhost/tests_site/N3/web/js/';

    $singleton = [
        // CSS
        'stylesheets' => [
            '' => [
                'styles.css',
            ],
            'register' => [
                'register.css',
                'styles.css',
            ],
            'login' => [
                'login.css',
                'styles.css',
            ],
            'account' => [
                'styles.css',
            ],
            'verification' => [
                'styles.css',
            ],
            'modify_pwd' => [
                'styles.css',
            ],
        ],

        // JS
        'scripts' => [
            'register' => [
                'checkboxes_pwd.js',
                'generate_pwd.js',
            ],
            'login' => [
                'checkboxes_pwd.js',
            ],
            'modify_pwd' => [
                'checkboxes_pwd.js',
                'generate_pwd.js',
            ],
        ],
    ];