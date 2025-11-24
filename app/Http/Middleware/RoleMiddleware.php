<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('error', 'Please login first.');
        }

        // Convert roles (admin|author) into array
        $allowedRoles = explode('|', $roles);

        // Check if user role is in allowed roles
        if (!in_array(Auth::user()->role, $allowedRoles)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
