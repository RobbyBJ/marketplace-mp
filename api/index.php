<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

define('LARAVEL_START', microtime(true));

// 1. Load the Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Boot the Laravel Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Handle the incoming request
$app->handleRequest(Request::capture());
