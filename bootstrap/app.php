<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\MiddlewarePriority;
  
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {  
        $middleware->validateCsrfTokens(except: [
            '/razorpay-success',        
            '/payu_success',
            '/payu_fail',
            '/app_payu_success',
            '/app_payu_failed',
            '/sslcommerz/*',
            '/cinetpay/*'
        ]);       
        // $middleware->alias([
        //     'auth' => \App\Http\Middleware\Authenticate::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

 

return $app;    