<?php


namespace App\Engine\Html\Input;


class Email extends Text
{
    public array $attributes = [
        'type' => 'email',
        'autocomplete' => 'off',
        'required' => true,
        'pattern' => '^([\w\-\.]{2,30})@(\w+)\.([a-z]{2,8})$'
    ];
}