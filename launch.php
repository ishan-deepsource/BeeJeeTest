<?php

const LOC_ROOT = __DIR__ . '/';
const LOC_VIEWS = LOC_ROOT . '/App/Views/';
const LOC_PUBLIC = LOC_ROOT . 'public/';

set_include_path(LOC_ROOT);
spl_autoload_register(fn($class) => require(strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php'));
set_error_handler(fn($no, $str, $file, $line) => new \Exception("{$file}:{$line} - {$str}"));