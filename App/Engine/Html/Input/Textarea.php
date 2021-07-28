<?php


namespace App\Engine\Html\Input;


class Textarea extends Text
{
    public string $name = 'textarea';
    public ?string $content = '';
    public array $attributes = ['autocomplete' => 'off', 'required' => true];

    public function setValue(mixed $value): static
    {
        $value = strval($value);
        $value = trim($value);
        $value = htmlentities($value, ENT_QUOTES, double_encode: false);

        $this->content = $value;
        return $this;
    }

    public function getValue(): ?string
    {
        return $this->content;
    }
}