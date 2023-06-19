<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role_id == 1) {
            return $next($request);
        }

        return Redirect::route('home')->with('error', 'You do not have sufficient privileges to access this page.');
    }

    // public function handle($request, Closure $next)
    // {
    //     if (auth()->check() && auth()->user()->role_id == 1) {
    //         return $next($request);
    //     }

    //     abort(403, 'Unauthorized');
    // }
}

