<?php

namespace App\Http\Middleware;

use Closure;

class MasterMiddleware
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
        if (Auth::guard($guard)->check() && user()->isMaster()) {
			return $next($request);
        }
        return redirect('/login')->withError(trans('messages.access_denied')
		);
    }
}