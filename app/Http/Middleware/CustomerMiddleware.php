<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'customer') {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'Unauthorized. Customer access only.'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Access denied. Customer privileges required.');
        }

        return $next($request);
    }
}
