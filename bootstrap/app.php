<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isLogin' => \App\Http\Middleware\IsLogIn::class,
            'isGuest' => \App\Http\Middleware\IsGuest::class,
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isVerif' => \App\Http\Middleware\IsVerif::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    
    
    
