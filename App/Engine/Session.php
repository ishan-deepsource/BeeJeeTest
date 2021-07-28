<?php


namespace App\Engine;


class Session
{
    public function __construct(string $name = '', array $options = [], string $handler = '')
    {
        if ($name) session_name($name);
        if ($options) session_set_cookie_params($options);
        if ($handler) session_module_name($handler);

        session_start();
    }

    public function __get($name)
    {
        return $_SESSION[$name] ?? null;
    }

    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }

    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }
}