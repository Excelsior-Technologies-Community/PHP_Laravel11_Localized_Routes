<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TranslationController;

Route::localized(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
});

Route::get('/admin/translations/{lang?}', [TranslationController::class, 'index'])->name('translations.index');
Route::post('/admin/translations/{lang}', [TranslationController::class, 'update'])->name('translations.update');