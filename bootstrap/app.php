<?php

use App\Http\Middleware\LogMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\ValidationError;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(LogMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationError $exception, Request $request){
            return response("Bad Request", 400);
        });
    })->create();
