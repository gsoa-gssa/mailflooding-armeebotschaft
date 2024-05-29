<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(App\Http\Middleware\ChangeLocale::class);
    })
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('emails:send')->everyMinute();
        // $schedule->command('app:stats')->everyTenMinutes();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
