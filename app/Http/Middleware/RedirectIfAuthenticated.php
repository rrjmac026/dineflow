<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->role === 'customer') {
                    return redirect(RouteServiceProvider::CUSTOMER_HOME);
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}