<?php


namespace App\Engine\Html;


use App\Engine\Html\Input\AbstractInput;

class Form
{
    public array $fields = [];
    public array $errors = [];

    public bool $processed = false;
    public bool $succeeded = false;

    public function __get($name)
    {
        return $this->fields[$name];
    }

    public function __set($name, $value)
    {
        $this->fields[$name] = $value->setAttribute('name', $name);
    }

    public function get(string $name): mixed
    {
        return $this->fields[$name]->getValue();
    }

    public function process(array $data): bool
    {

        /** @var AbstractInput $field */
        foreach ($this->fields as $name => $field) {

            if ($error = $field->setValue(strval($data[$name] ?? ''))->validate()) {

                $this->errors[$name] = $error;
            }
        }

        $this->processed = true;
        $this->succeeded = empty($this->errors);

        return $this->succeeded;
    }

    public function render(string $name, array $attrs = []): void
    {
        $this->fields[$name]->render($attrs);
    }

    public function reset(): void
    {
        $this->errors = [];
        $this->succeeded = false;
        $this->processed = false;
    }

    public function getCause(): ?string
    {
        return $this->processed ? strval($this->errors['cause'] ?? current($this->errors)) : null;
    }

    public function setCause(string $cause): static
    {
        $this->errors['cause'] = $cause;
        return $this;
    }

    public function setError(string $name, string $value): static
    {
        $this->errors[$name] = $value;
        $this->succeeded = false;
        return $this;
    }
}