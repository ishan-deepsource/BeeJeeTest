<?php


namespace App\Engine;


class Request
{
    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
    }

    public function isGet(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function getCookie(string $name): string
    {
        return $_COOKIE[$name] ?? '';
    }
}