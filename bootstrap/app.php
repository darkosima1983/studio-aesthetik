<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
        $middleware->redirectTo(
        guests: '/login',
        users: '/' // Ovde postavi putanju gde želiš da klijent ide (npr. '/' ili '/shop')
    );
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
    