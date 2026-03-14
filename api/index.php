<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

define('LARAVEL_START', microtime(true));

// 1. Load the Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Vercel Support: Ensure /tmp storage structure exists
if (isset($_SERVER['VERCEL'])) {
    $dirs = [
        '/tmp/storage/app/public',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
}

// 3. Boot the Laravel Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 4. Force storage path to /tmp if on Vercel
if (isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
}

// 3. Handle the incoming request
$app->handleRequest(Request::capture());
