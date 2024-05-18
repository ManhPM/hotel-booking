<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'PAGE NOT FOUND'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Bạn chưa đăng nhập'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $e);
    }
}
