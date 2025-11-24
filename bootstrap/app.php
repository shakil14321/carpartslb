<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'prevent-back-history' => PreventBackHistory::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (NotFoundHttpException $ex, $request) {
            $view = $request->is('admin/*')
                ? 'admin.errors.404'
                : 'front.errors.404';

            if (view()->exists($view)) {
                return response()->view($view, ['exception' => $ex], 404);
            }

            // fallback jab custom view exist na kare
            return response()->view('errors.404', ['exception' => $ex], 404);
        });
    })
    ->create();
