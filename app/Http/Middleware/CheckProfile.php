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
        if ($request->user()->role == 2 && !$request->user()->staff_info) {
            return redirect('profile/' . $request->user()->id)->with('error', "You need to complete your profile before accessing this system!");
        }

        return $next($request);
    }
}
