<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('template', [HomeController::class, 'template']);
Route::get('generate-receipt', [HomeController::class, 'generate']);
