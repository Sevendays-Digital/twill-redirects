<?php

namespace TwillRedirects\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use TwillRedirects\Facades\RedirectManager;

class TwillRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($redirect = RedirectManager::getRedirectForRequest($request)) {
            return new RedirectResponse(
                $redirect->getTarget(),
                $redirect->code ?? 301
            );
        }

        return $next($request);
    }
}
