<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => 'Acceso prohibido'], Response::HTTP_FORBIDDEN);
        }

        if($exception instanceof RouteNotFoundException)
        {
            return response()->json(['message' => 'No has iniciado session'], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['message' => 'Método no encontrado o soportado'], Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return parent::render($request, $exception);
    }

}
