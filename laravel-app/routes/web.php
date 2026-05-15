<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WoundController;
use App\Http\Controllers\PredictionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/upload-wound', [WoundController::class, 'upload'])->name('wound.upload');

#Routing post model predict dari Prediction Controller
Route::post('/welcome', [PredictionController::class, 'predict']);
