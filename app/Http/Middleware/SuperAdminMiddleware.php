<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is a superadmin
        if (!auth()->check() || auth()->user()->role !== 'superadmin') {
            // Redirect them to a page if they are not a superadmin
            return redirect('/');  // Or a custom page like 'superadmin/login'
        }

        return $next($request);
    }
}
