<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $e): object
    {
        if($e instanceof ValidationException) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }

        if($e instanceof AuthorizationException) {
            return response()->json(['errors' => $e->getMessage()], 403);
        }

        if($e instanceof NotFoundHttpException) {
            return response()->json(['errors' => 'Route not found'], 404);
        }

        if($e instanceof AppError) {
            return response()->json(['errors' => $e->getMessage()], $e->getCode());
        }

        return response()->json(['errors' => $e->getMessage()], 500);
    }
}
