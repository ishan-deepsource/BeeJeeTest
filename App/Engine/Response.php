<?php


namespace App\Engine;


class Response
{
    public function setStatus(int $code):static {
        http_response_code($code); return $this;
    }

    public function setHeader(string $header, string $value):static {
        header("{$header}: {$value}", true); return $this;
    }

    public function setCookie(string $name, string $value, array $options = []):static {
        if (empty($value)) $options['expires'] = -1;
        setcookie($name, $value, $options);
        return $this;
    }

    public function redirect(string $url, int $code = 302):static {
        header("Location: {$url}", true, $code); return $this;
    }
}