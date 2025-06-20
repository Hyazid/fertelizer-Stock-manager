<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!Auth::check()){
            return redirect()->route('auth.login');

        }
        $user = Auth::user();
        if(!in_array($user->role,$roles)){
            //dd(Auth::user()->role); // should now output: "UCC"

            abort(403,'Unauthorized');
            
        }
        return $next($request);
    }
}
