<?php
if (isset($_SERVER['REQUEST_URI']) && str_contains($_SERVER['REQUEST_URI'], '/chat/stream')) {
    // Disable all output buffering layers
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    
    // Turn on implicit flush
    if (function_exists('apache_setenv')) {
        apache_setenv('no-gzip', '1');
    }
    
    // Send SSE headers
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Connection: keep-alive');
    header('X-Accel-Buffering: no');
    
    // Flush immediately
    if (ob_get_level() > 0) ob_flush();
    flush();
}
// =====================================================

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

use Illuminate\Foundation\Application;


define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
