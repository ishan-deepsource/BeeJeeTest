<?php return [
    '/' => ['Index', 'index', ['GET']],

    '/login' => ['User', 'login', ['GET', 'POST']],
    '/logout' => ['User', 'logout', ['GET', 'POST']],

    '/compose/(\d*)' => ['Task', 'compose', ['GET', 'POST']]
];