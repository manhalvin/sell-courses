<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlockIpOnTooManyAttempts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $key = sprintf('%s-%s', 'failed-login-attempts', $request->ip());
        $attempts = Cache::get($key, 0) + 1;
        Cache::put($key, $attempts, 10);

        if ($attempts > 5) {
            return response()->json(['error' => 'Too many login attempts'], 429);
        }

        return $next($request);
    }
}
