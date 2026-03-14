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
        $command = request('fresh') === 'yes' ? 'migrate:fresh' : 'migrate';
        \Illuminate\Support\Facades\Artisan::call($command, ['--force' => true]);
        return '<h1>Command: ' . $command . '</h1><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>' . 
               '<br><a href="/debug-migrate?fresh=yes">Click here to run MIGRATE:FRESH (Wipe and restart)</a>';
    } catch (\Exception $e) {
        return '<h1>Migration failed</h1><pre>' . $e->getMessage() . '</pre>' .
               '<br><a href="/debug-migrate?fresh=yes">Click here to run MIGRATE:FRESH (Wipe and restart)</a>';
    }
});