<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsActiveMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (!Auth::user()->is_active) {
                return redirect()->route('login')->with('error', 'Your account is inactive. Please contact the administrator.');
            }
        }
        return $next($request);
    }
}
