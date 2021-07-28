<?php return [
    'config' => function($app) {
        return new \App\Engine\Config(require('config.php'));
    },

    'view' => function($app) {
        return new \App\Engine\View(LOC_VIEWS);
    },

    'db' => function($app) {
        return new \App\Engine\Database\Mysql(
            $app->config->database->address,
            $app->config->database->username,
            $app->config->database->password,
            $app->config->database->database,
            $app->config->database->charset
        );
    },

    'session' => function($app) {
        return new \App\Engine\Session('SESSID');
    },

    'flash' => function($app) {
        return new \App\Engine\Flash($app->session);
    }
];