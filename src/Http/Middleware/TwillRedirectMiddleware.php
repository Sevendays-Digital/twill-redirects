<?php

namespace TwillRedirects\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use TwillRedirects\Facades\RedirectManager;

class TwillRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($redirect = RedirectManager::getRedirectForRequest($request)) {
            redirect($redirect->getTarget(), $redirect->code ?? 301)->send();
            exit;
        }

        return $next($request);
    }
}
