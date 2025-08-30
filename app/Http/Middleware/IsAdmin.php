<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role == 'admin') {
            // If they are an admin, allow them to proceed to the next request
            return $next($request);
        }

        // If not an admin, abort the request and show a 403 Forbidden error page.
        // This is more secure than redirecting.
        abort(403, 'Unauthorized Action');
    }
}

