<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class HelloMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!preg_match('/jelmer$/i', $request->getRequestUri())) {
            return response("Toegang geweigerd", 403);
        }

        return $next($request);
    }
}