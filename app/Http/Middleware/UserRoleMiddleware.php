<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {

        if (!$request->user()) {
            abort(403, 'Unauthorized. User not logged in.');
        }

        if ($request->user()->role !== $role) {
            abort(403, 'Unauthorized. Access denied.');
        }

        return $next($request);
    }
}
