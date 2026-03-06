<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::localized(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
});