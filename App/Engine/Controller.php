<?php


namespace App\Engine;


class Controller
{
    public string $controller;
    public string $action;

    public Request $request;
    public Response $response;

    public static self $instance;

    private array $services = [];

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();

        self::$instance = $this;
    }

    public function __isset($name)
    {
        return isset($services[$name]);
    }

    public function __get($name)
    {
        if (!isset($this->services[$name]))
        {
            throw new \Exception("Not found: {$name}");
        }

        $service = $this->services[$name]($this);

        return $this->{$name} = $service;
    }

    public function initialize()
    {
    }

    public function finalize()
    {
    }

    public static function run(string $uri, string $method):static
    {
        $route = \App\Engine\Router::direct(
            require('routes.php'),
            strstr("{$uri}?", '?', true),
            $method
        );

        $class      = "\App\Controllers\\{$route[0]}Controller";
        $action     = "{$route[1]}Action";

        $controller = new $class();
        $controller->services   = require('loader.php');
        $controller->controller = $route[0];
        $controller->action     = $route[1];

        $controller->initialize() ??
        $controller->$action(...$route[2]);
        $controller->finalize();

        return $controller;
    }
}