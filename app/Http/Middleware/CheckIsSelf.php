<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsSelf
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
        $requestedUserId = $request->route()->parameter('id');

        if (Auth::user()->id == $requestedUserId) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Unauthorized request'], 403);
        }
    }
}
