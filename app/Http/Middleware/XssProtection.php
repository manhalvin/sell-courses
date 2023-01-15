<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XssProtection
{
    /**
     * Create a middleware that will automatically check user input
     *  for any potentially dangerous code and remove or escape
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            $input = htmlspecialchars(strip_tags(trim($input)));
        });
        $request->merge($input);
        return $next($request);
    }

}
