<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => class_basename($e->getModel())." not found or has been deleted.",
            ], Response::HTTP_NOT_FOUND);
        });

        // Handle NotFoundHttpException (optional)
        $exceptions->render(function (NotFoundHttpException $e) {
            if ($e->getPrevious() instanceof ModelNotFoundException) {
                $modelName = class_basename($e->getPrevious()->getModel());
                return response()->json([
                    'status' => false,
                    'message' =>  $modelName. ' not found or has been deleted.',
                ], Response::HTTP_NOT_FOUND);
            }
        });
    })->create();
