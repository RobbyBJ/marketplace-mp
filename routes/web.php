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
        
        // 1. List all current tables
        $dbName = config('database.connections.mysql.database');
        $tables = \Illuminate\Support\Facades\DB::select('SHOW TABLES');
        $tableList = array_map(fn($t) => current((array)$t), $tables);
        
        $output = "<h1>Database: $dbName</h1>";
        $output .= "<h3>Current Tables (" . count($tableList) . "):</h3>";
        $output .= "<ul><li>" . implode("</li><li>", $tableList) . "</li></ul>";

        if ($action === 'nuke') {
            // Drop ALL tables dynamically
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            foreach ($tableList as $table) {
                \Illuminate\Support\Facades\Schema::dropIfExists($table);
            }
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
            return '<h1>Database Nuked</h1><p>All tables were dropped. Now <a href="/debug-migrate?action=migrate">click here to run MIGRATE</a>.</p>';
        }

        if ($action === 'migrate') {
            \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
            $commandOutput = \Illuminate\Support\Facades\Artisan::output();
            return "<h1>Migrate Output</h1><pre>$commandOutput</pre><hr><a href='/debug-migrate'>Back to Status</a>";
        }

        $output .= "<hr>";
        $output .= "<a href='/debug-migrate?action=migrate' style='padding:10px;background:green;color:white;text-decoration:none;'>RUN MIGRATE</a> ";
        $output .= "<a href='/debug-migrate?action=nuke' style='padding:10px;background:red;color:white;text-decoration:none;' onclick='return confirm(\"Are you sure? This deletes ALL data.\")'>NUKE ALL TABLES</a>";
        
        return $output;
    } catch (\Exception $e) {
        return '<h1>Database Error</h1><pre>' . $e->getMessage() . '</pre>' .
               '<hr>' .
               '<a href="/debug-migrate">Try Refreshing</a> | ' .
               '<a href="/debug-migrate?action=nuke">Emergency Nuke (If nothing else works)</a>';
    }
});