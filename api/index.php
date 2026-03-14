<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

// Forward Vercel requests to the public/index.php
$app = require __DIR__ . '/../public/index.php';

// Auto-run migrations on deployment if enabled or if tables are missing
if (env('DB_AUTO_MIGRATE') === 'true' || !Schema::hasTable('users')) {
    Artisan::call('migrate', ['--force' => true]);
}
