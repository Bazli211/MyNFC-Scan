<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            if ($role === 'student' && !empty($user->matric_number)) {
                return $next($request);
            }
    
            if ($role === 'staff' && !empty($user->staff_id)) {
                return $next($request);
            }
        }
    
        // Log unauthorized attempts
        \Log::warning('Unauthorized access attempt', [
            'role' => $role,
            'user' => Auth::check() ? Auth::user()->toArray() : null,
        ]);
    
        abort(403, 'Unauthorized access.');
    }    
}

