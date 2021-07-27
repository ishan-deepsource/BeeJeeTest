<?php


namespace App\Engine\Html\Input;


abstract class AbstractInput extends \App\Engine\Html\AbstractTag
{
    public function __construct(array $attributes = []) {

        if (isset($attributes['value']))
        {
            $this->setValue($attributes['value']);
            unset($attributes['value']);
        }

        parent::__construct($attributes);
    }

    abstract public function validate():?string;

    abstract public function getValue():mixed;

    abstract public function setValue(mixed $value):static;
}