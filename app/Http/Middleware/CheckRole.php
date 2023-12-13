<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role == 'admin' && auth()->user()->status == 'active') {
            return $next($request);
        } elseif (auth()->check() && (auth()->user()->role != 'admin' || auth()->user()->status != 'active')) {
            auth()->logout();
            return redirect('/login');
        } else {
            return redirect('/login');
        }
    }
}
