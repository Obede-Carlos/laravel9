<?php

use Illuminate\Support\Facades\Route;

//Prueba para cargar login de ui laravel en bootstrap
Route::get('/', function () { 
    return view('welcome');   
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
