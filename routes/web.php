<?php

use App\Exceptions\ValidationError;
use App\Http\Controllers\SpaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\auth;

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

//Route ke halaman MessageToWhatsapp
Route::get('/message', function(){
    return view('MessageToWhatsapp');
});

Route::resource('space', SpaceController::class )->middleware(auth::class, 'redirectTo');