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

// Vercel Support: Proxy route to serve images from /tmp
Route::get('/storage/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!Illuminate\Support\Facades\File::exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath);
})->where('path', '.*');