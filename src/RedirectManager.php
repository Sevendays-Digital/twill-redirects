<?php

namespace TwillRedirects;

use A17\Twill\Models\Model;
use Closure;
use Illuminate\Http\Request;
use TwillRedirects\Twill\Capsules\Redirects\Models\Redirect;

class RedirectManager
{
    public static array $resolved = [];

    public static Closure $entityCallback;

    public function __construct()
    {
        $this->onTwillEntityRedirect(function(Model $model) {
            return $model->slug ?? '';
        });
    }

    public function onTwillEntityRedirect(Closure $callback): void {
        self::$entityCallback = $callback;
    }

    public function getEntityCallback(): Closure {
        return self::$entityCallback;
    }

    public function getRedirectForRequest(Request $request): ?Redirect {
        return $this->getRedirectForPath($request->path());
    }

    public function getRedirectForPath(string $path): ?Redirect {
        return Redirect::firstWhere('from', $path);
    }
}
