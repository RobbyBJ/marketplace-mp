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

// Registration Page
Route::get('/register', Register::class)->name('register');

// Login Page
Route::get('/login', Login::class)->name('login');

// Listings Page (assuming you have a Listings component)
Route::get('/listings', Listings::class)->name('listings')->middleware('auth');