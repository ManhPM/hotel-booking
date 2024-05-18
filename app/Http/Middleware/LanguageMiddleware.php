<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->hasCookie('website_language')) {
            $language = $request->cookie('website_language');
            App::setLocale($language);
        } else {
            App::setLocale('VI');
        }

        return $next($request);
    }
}
