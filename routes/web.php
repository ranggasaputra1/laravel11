<?php

use App\Exceptions\ValidationError;
use Illuminate\Support\Facades\Route;

// Route for first open the app
Route::get('/', function () {
    return view('welcome');
});

// Route for dashboard pages
Route::get('/dashboard', function(){
    return view('dashboard');
});

//Route mencoba fitur exception error
Route::get("/validation", function(){
    throw new ValidationError("Invalid Input");
});