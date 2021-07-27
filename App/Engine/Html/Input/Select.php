<?php


namespace App\Engine\Html\Input;


use App\Engine\Html\AbstractTag;

class Select extends AbstractInput
{
    public string $name = 'select';
    public array $attributes = ['autocomplete' => 'off', 'required' => true];
    public array $options = [];
    public string $value = '';

    public function __construct(array $attributes = [])
    {
        if (isset($attributes['options']))
        {
            $this->options = $attributes['options'];
            unset($attributes['options']);
        }

        parent::__construct($attributes);
    }

    public function validate(): ?string
    {
        $title = $this->attributes['title'] ?? 'undefined';
        $value = $this->getValue();

        if ($value === null or $value === '') {
            return empty($this->attributes['required']) ? null : "{$title}: должен быть указан.";
        }

        if (!array_key_exists($value, $this->options)) {
            return "{$title}: значение отсутствует в списке вариантов.";
        }

        return null;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): static
    {
        $this->value = is_scalar($value) ? $value : strval($value); return $this;
    }

    public function render(array $attributes = []): static
    {
        $content = '';

        foreach ($this->options as $value => $name) {
            if ($this->value == $value)
            {
                $format = '<option value="%s" selected>%s</option>';
            } else {
                $format = '<option value="%s">%s</option>';
            }

            $content .= sprintf($format, $value, $name);
        }

        AbstractTag::renderStatic($this->name, array_merge($this->attributes, $attributes), $content);
        return $this;
    }
}