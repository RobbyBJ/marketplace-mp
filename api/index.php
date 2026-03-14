<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

// Forward Vercel requests to the public/index.php
$app = require __DIR__ . '/../public/index.php';

// Auto-run migrations on deployment if enabled
if (env('DB_AUTO_MIGRATE') === 'true') {
    Artisan::call('migrate', ['--force' => true]);
}
