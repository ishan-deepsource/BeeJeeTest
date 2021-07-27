<?php


namespace App\Engine\Html;


abstract class AbstractTag
{
    public string $name;
    public ?string $content = null;
    public array $attributes = [];

    public function __construct(array $attributes = [])
    {
        if ($attributes)
        {
            $this->attributes = array_merge($this->attributes, $attributes);
        }
    }

    public function setAttribute(string $name, mixed $value):static {
        $this->attributes[$name] = (string) $value; return $this;
    }

    public function getAttribute(string $name):string {
        return $this->attributes[$name];
    }

    public function setContent(?string $value):static {
        $this->content = $value; return $this;
    }

    public function render(array $attributes = []):static {
        self::renderStatic($this->name, array_merge($this->attributes, $attributes), $this->content); return $this;
    }

    public static function renderStatic(string $name, array $attributes, ?string $content = null):void {
        echo '<', $name;

        foreach ($attributes as $attribute => $value) {
            if ($value === '' or $value === null or $value === false) continue;

            echo ' ', $attribute;

            if ($value !== true) {
                echo '="', htmlentities($value), '"';
            }
        }

        if ($content === null) echo ' />'; else echo '>', $content, '</', $name, '>';
    }
}