<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;

Route::get('/', function () {
    return view('upload');
});

#Routing post model predict dari Prediction Controller
Route::post('/predict', [PredictionController::class, 'predict']);