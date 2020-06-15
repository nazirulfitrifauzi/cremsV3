<?php

namespace App\Http\Middleware;

use Closure;

class CheckHR
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role == 3 || $request->user()->role == 4) {
            return redirect('home')->with('error', "You don't have permission to access this page!");
        }

        return $next($request);
    }
}
