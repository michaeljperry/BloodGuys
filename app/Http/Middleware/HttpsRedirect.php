<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class HttpsRedirect {
    public function handle($request, Closure $next)
    {
        if(!$request->secure() && env('APP_ENV') === 'production')
        {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}

