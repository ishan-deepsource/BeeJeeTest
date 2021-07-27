<?php


namespace App\Engine\Html\Input;


class Text extends AbstractInput
{
    public string $name = 'input';
    public array $attributes = ['type' => 'text', 'autocomplete' => 'off', 'required' => true];

    public function validate(): ?string
    {
        $title = $this->attributes['title'] ?? 'undefined';
        $value = $this->getValue();

        if ($value === null or $value === '') {
            return empty($this->attributes['required']) ? null : "{$title}: должен быть указан.";
        }

        $length = mb_strlen($value);

        if (isset($this->attributes['minlength']) and $length < $this->attributes['minlength'])
        {
            return "{$title}: должен быть не менее {$this->attributes['minlength']} символа(ов)";
        }

        if (isset($this->attributes['maxlength']) and $length > $this->attributes['maxlength'])
        {
            return "{$title}: должен быть не более {$this->attributes['minlength']} символа(ов)";
        }

        if (isset($this->attributes['pattern']) and !preg_match("/{$this->attributes['pattern']}/u", $value))
        {
            return "{$title}: должен быть указанного формата.";
        }

        return null;
    }

    public function setValue(mixed $value): static
    {
        $value = strval($value);
        $value = trim($value);
        $value = htmlentities($value, ENT_QUOTES, double_encode: false);

        $this->attributes['value'] = $value; return $this;
    }

    public function getValue(): mixed
    {
        return $this->attributes['value'] ?? '';
    }
}