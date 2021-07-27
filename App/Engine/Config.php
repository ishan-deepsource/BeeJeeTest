<?php


namespace App\Engine;


class Config
{
    public function __construct($values)
    {
        foreach ($values as $key => $value)
        {
            $this->{$key} = is_array($value) ? new self($value) : $value;
        }
    }
}