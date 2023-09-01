<?php

namespace TwillRedirects;

use A17\Twill\TwillPackageServiceProvider;

class TwillRedirectsServiceProvider extends TwillPackageServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/twill_redirects.php', 'twill_redirects'
        );
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/twill_redirects.php' => config_path('twill_redirects.php'),
        ], 'twill-redirects-config');

        parent::boot();
    }
}
