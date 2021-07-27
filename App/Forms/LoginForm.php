<?php


namespace App\Forms;


use App\Engine\Html\Input\Password;
use App\Engine\Html\Input\Text;

class LoginForm extends \App\Engine\Html\Form
{
    public function __construct()
    {
        $this->username = new Text([
            'title' => 'Логин',
            'minlength' => 4,
            'maxlength' => 16,
            'pattern' => '^[a-zA-Z0-9_]+$'
        ]);

        $this->password = new Password([
            'title' => 'Пароль',
            'minlength' => 2,
            'maxlength' => 30
        ]);
    }
}