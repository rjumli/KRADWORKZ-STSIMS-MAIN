<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NothingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Auth::check()) {
            if (\Auth::user()->role != 'Administrator') {
                return redirect()->route('login')->with('error', 'Your account is inactive. Please contact the administrator.');
            }
        }
        return $next($request);
    }
}
