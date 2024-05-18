<?php

namespace App\Http\Middleware;

use App\Services\MessageService;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return response()->json([
                'message' => 'Bạn chưa nhập thông tin đăng nhập'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
