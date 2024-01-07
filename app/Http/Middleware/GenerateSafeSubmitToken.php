<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\SafeSubmit\SafeSubmit;

class GenerateSafeSubmitToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $safeSubmit = app(safeSubmit::class);

        if($this->isReading($request)){

            $safeSubmit->regenerateToken();
        }

        return $next($request);
    }

    //kradzione z VerifyCrsfToken.php
    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }
}
