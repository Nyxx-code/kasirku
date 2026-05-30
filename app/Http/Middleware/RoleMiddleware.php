<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (! $user) {
            abort(401);
        }

        $userRole = strtolower($user->role);
        $allowedRoles = array_map('strtolower', $roles);

        if ($roles !== [] && ! in_array($userRole, $allowedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}