<?php

use Illuminate\Foundation\Application;
use CodeZero\LocalizedRoutes\Middleware\SetLocale;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function ($middleware) {
        $middleware->web(append: [
            SetLocale::class, // This must be applied
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();