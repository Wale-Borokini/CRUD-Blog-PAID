<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the admin role
        if (auth()->check() && auth()->user()->isSuperAdmin()) {
            return $next($request);
        }

        // If not authenticated or not an admin, redirect to a different route or show an error message
        //return redirect()->route('profile'); 
        abort(403);

    }
}
