<?php

namespace App\Http\Middleware;

use Closure;

class CheckProfile
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
        if (!$request->user()->profiles) {
            return back()->with('error', "You have to complete your profile before accessing the system!");
        }

        return $next($request);
    }
}
