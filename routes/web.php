<?php

use App\Models\Listings;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {  
    return view('welcome');
});

