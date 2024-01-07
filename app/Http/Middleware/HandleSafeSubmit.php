<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\SafeSubmit\SafeSubmit;
use Illuminate\Support\Facades\View;
//testowanie redirect zamiast abort(419)

class HandleSafeSubmit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $safeSubmit = app(safeSubmit::class);

        if($request->{$safeSubmit->tokenKey()} != $safeSubmit->token()){
            if($intended = $safeSubmit->getIntended()){
                $safeSubmit->forgetIntended();

                return redirect($intended);

            }
            // return redirect($intended)->setStatusCode('419', 'Page has expired');
            // return response()->redirectTo($intended)->status(419, 'Page has expired');


            abort(419, 'Page has expired');

            // return redirect()->back()->withErrors([
            //     'error' => 'Page has expired'
            // ]);

            // return redirect($intended)->with([
            //     'error' => 'Page has expired'
            // ]);
            // abort(redirect($intended));

            // return response()->redirectTo($intended)->setStatusCode(419, 'Page has expired');
            // return redirect($intended)->with('status', 'Page exiper!');
        }

        $safeSubmit->regenerateToken();

        return $next($request);
    }

}
