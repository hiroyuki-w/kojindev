<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;

class Login
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
        if (Auth::check() || Session::has('socialUser')) {
            return $next($request);
        }
        abort(403);
    }
}
