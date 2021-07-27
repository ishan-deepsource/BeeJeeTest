<?php


namespace App\Engine;


class View
{
    public function __construct(
        public string $path
    ) {}

    public function render(string $file, array $vars = []):void {
        $file = strtr($file, '/', DIRECTORY_SEPARATOR);
        $file = ucwords($file, DIRECTORY_SEPARATOR);

        if ($vars) extract($vars, EXTR_SKIP | EXTR_REFS);

        require($this->path . $file . '.phtml');
    }

    public function __get($name)
    {
        return Controller::$instance->{$name};
    }

    public function __isset($name)
    {
        return isset(Controller::$instance->{$name});
    }
}