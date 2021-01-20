<?php

namespace App\Http\Middleware;

use Closure;

class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = ($request->hasHeader('X-localization') ? $request->header('X-localization') : env('DEFAULT_LANG'));
        $local = $request->user()->language ? $request->user()->language : $local;

        app()->setLocale($local);

        return $next($request);
    }
}
