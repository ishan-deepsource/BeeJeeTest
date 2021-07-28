<?php


namespace App\Engine\Html\Input;


class Password extends Text
{
    public array $attributes = ['type' => 'password', 'autocomplete' => 'off', 'required' => true];

    public function render(array $attributes = []): static
    {
        return parent::render(array_merge($attributes, ['value' => '']));
    }
}