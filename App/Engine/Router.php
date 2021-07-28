<?php


namespace App\Engine;


class Router
{
    public static function direct(array $routes, string $uri, string $method = 'GET'): array
    {

        foreach ($routes as $route => $target) {
            if (isset($target[2]) and !in_array($method, $target[2], true)) continue;
            if (!preg_match("#^{$route}$#", $uri, $params)) continue;

            array_shift($params);
            $target[2] = $params;

            return $target;
        }

        return ['Index', 'notFound', [$uri, $method]];
    }
}