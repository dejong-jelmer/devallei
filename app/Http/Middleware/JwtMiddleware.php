<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        
        $token = $request->get('token');
        
        if(!$token) {
            
            return response()->json([
                'error' => 'Geen token meegestuurd.'
            ], 401);
        }

        try {

            $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        
        } catch(ExpiredException $e) {
            
            return response()->json([
                'error' => 'Meegestuurde token is verlopen.'
            ], 400);
        
        } catch(Exception $e) {
            
            return response()->json([
                'error' => 'Er is iets mis gegaan met het decoderen van de token.'
            ], 400);
        }

        $user = User::find($credentials->sub);

        $request->auth = $user;

        return $next($request);
    }
}
