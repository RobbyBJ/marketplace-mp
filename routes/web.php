<?php

use App\Livewire\Home;
use App\Livewire\Register;
use App\Livewire\Login;
use App\Livewire\Listings;
use Illuminate\Support\Facades\Route;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', Home::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/listings', Listings::class)->name('listings')->middleware('auth');

Route::get('/debug-migrate', function () {
    try {
        $action = request('action');
        
        if ($action === 'wipe') {
            // Faster manual wipe to avoid Vercel timeouts
            $tables = ['listings', 'users', 'jobs', 'cache', 'migrations', 'sessions', 'password_reset_tokens'];
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            foreach ($tables as $table) {
                \Illuminate\Support\Facades\Schema::dropIfExists($table);
            }
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
            return '<h1>Database Wiped</h1><p>The core tables were dropped. Now <a href="/debug-migrate?action=migrate">click here to run MIGRATE</a>.</p>';
        }

        $command = $action === 'fresh' ? 'migrate:fresh' : 'migrate';
        \Illuminate\Support\Facades\Artisan::call($command, ['--force' => true]);
        
        return '<h1>Command: ' . $command . '</h1><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>' . 
               '<hr>' .
               '<a href="/debug-migrate?action=migrate">Run Migrate</a> | ' .
               '<a href="/debug-migrate?action=fresh">Run Migrate Fresh (Warning: Timeout prone)</a> | ' .
               '<a href="/debug-migrate?action=wipe">Force Wipe (Fastest)</a>';
    } catch (\Exception $e) {
        return '<h1>Migration failed</h1><pre>' . $e->getMessage() . '</pre>' .
               '<hr>' .
               '<a href="/debug-migrate?action=migrate">Try standard Migrate</a> | ' .
               '<a href="/debug-migrate?action=wipe">Force Wipe (Use this if you get "Table already exists")</a>';
    }
});