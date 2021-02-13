<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HaveCompany
{
    public function handle(Request $request, Closure $next)
    {
        if(!isset(auth()->user()->company)) {
            return redirect()->route('companies.create')->with('success', 'Você precisar fazer parte de uma empresa, cadastre ou solicite acesso.');
        }
        return $next($request);
    }
}
