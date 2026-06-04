<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check() || Auth::user()->role !== User::ROLE_ADMIN) {
            abort(403, 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
