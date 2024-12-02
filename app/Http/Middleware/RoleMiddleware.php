<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = auth()->user();

        // Check role based on identifiers
        if ($role === 'student' && !isset($user->matric_number)) {
            abort(403, 'Unauthorized access.');
        }

        if ($role === 'staff' && !isset($user->staff_id)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
