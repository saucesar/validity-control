<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
        if($request->server()['REQUEST_METHOD'] == 'POST'){
            if( Auth::user()->isCompanyOwner()){
                return $next($request);
            } else {
                return back()->with('error', 'Voçê não tem permição para a ação!');
            }
        } else {
            return $next($request);
        }
    }
}
