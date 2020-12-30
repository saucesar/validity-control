<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGranted
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->access_granted){
            return $next($request);
        } else {
            return back()->with('error', 'Acesso não permitido!');
        }
    }
}
