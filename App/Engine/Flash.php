<?php


namespace App\Engine;


class Flash
{
    public array $classes = [
        'notify' => 'alert alert-info',
        'danger' => 'alert alert-danger',
        'success' => 'alert alert-success'
    ];

    public function __construct(
        public Session $session
    ) {}

    public function setClass(string $type, string $class):static
    {
        $this->classes[$type] = $class; return $this;
    }

    public function render():void
    {
        if (!isset($this->session->_flash)) return;

        $flash = $this->session->_flash;
        $flash[0] = $this->classes[$flash[0]];
        unset($this->session->_flash);

        echo sprintf('<div class="%s">%s</div>', $flash[0], $flash[1]);
    }

    public function notify(string $content):static
    {
        $this->session->_flash = ['notify', $content]; return $this;
    }

    public function success(string $content):static
    {
        $this->session->_flash = ['success', $content]; return $this;
    }

    public function danger(string $content):static
    {
        $this->session->_flash = ['danger', $content]; return $this;
    }
}