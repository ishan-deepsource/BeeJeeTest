<?php


namespace App\Engine;


class Text
{
    public static function base62SafeGenerate(int $length): string
    {
        $string = base64_encode(random_bytes(ceil($length * 0.75)));
        $string = strtr($string, ['/' => 'a', '+' => 'b', '=' => 'c']);

        return substr($string, 0, $length);
    }
}