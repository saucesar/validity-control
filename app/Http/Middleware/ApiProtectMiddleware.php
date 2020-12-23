<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiProtectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try{
            JWTAuth::parseToken()->authenticate();
        } catch(TokenInvalidException $e){
            return response()->json(['message' => 'Token is invalid!']);
        } catch(TokenExpiredException $e){
            return response()->json(['message' => 'Token is expired!']);
        } catch(Exception $e){
            return response()->json(['message' => 'Token not found!']);
        }

        return $next($request);
    }
}
