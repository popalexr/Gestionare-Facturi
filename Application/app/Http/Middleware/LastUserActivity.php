<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LastUserActivity
 * This middleware is used to update the last user activity in the cache every time a user makes a request.
 */
class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if(Auth::check()) {
            Cache::put('last-user-activity-' . $request->user()->id, now(), 3600);
        }

        return $response;
    }
}
