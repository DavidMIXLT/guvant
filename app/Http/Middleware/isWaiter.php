<?php

namespace AlaCartaYa\Http\Middleware;

use Closure;

class isWaiter
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

        if ($request->user()->authorizeRoles('waiter')) {
            return $next($request);
        } else {
            return abort(404);
        }

    }

}
