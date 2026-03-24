<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEmployee
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (Auth::user()->role !== 'employee') {
            // Admin users should be in the Filament panel
            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
