<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WoundController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload-wound', [WoundController::class, 'upload'])->name('wound.upload');
