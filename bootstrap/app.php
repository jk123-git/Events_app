<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
   // ->withMiddleware(function (Middleware $middleware): void {
        //
    //})

     ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class, 
        ]);
        // If you have any global middleware, they would go here as well,
        // for example, if you want to add to the web group:
        // $middleware->web(append: [
        //     // \App\Http\Middleware\YourCustomWebMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
