<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Add CSRF exception for webhook
        $middleware->validateCsrfTokens(except: [
            'razorpay-webhook',
        ]);

        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Redirect unauthenticated users to the correct login page
        $middleware->redirectGuestsTo(fn () => route('agent.login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
