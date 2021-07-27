<?php
declare(strict_types=1);
require('../launch.php');

use App\Engine\Controller as App;

try {
    ob_start();
    App::run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    ob_end_flush();
} catch (\Throwable $e) {
    ob_end_clean();
    
    header('Content-Type: text/plain', true, 500);
    echo $e->getFile(), ':', $e->getLine(), ' - ', $e->getMessage(), PHP_EOL, $e->getTraceAsString();
}
