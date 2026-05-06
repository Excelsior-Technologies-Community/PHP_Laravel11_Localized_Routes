<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use CodeZero\LocalizedRoutes\Middleware\SetLocale;
use App\Http\Middleware\StoreLocalePreference;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function ($middleware) {

        $middleware->web(append: [
            SetLocale::class,
            StoreLocalePreference::class, // ✅ ADD THIS
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();