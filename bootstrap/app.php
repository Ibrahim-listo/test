<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions as ConfigurationExceptions;
use Illuminate\Foundation\Configuration\Middleware as ConfigurationMiddleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use App\Http\Middleware\HandleInertiaRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (ConfigurationMiddleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (ConfigurationExceptions $exceptions) {
        //
    })->create();
