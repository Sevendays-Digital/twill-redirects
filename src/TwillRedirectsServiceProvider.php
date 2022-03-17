<?php

namespace TwillRedirects;

use A17\Twill\TwillPackageServiceProvider;

class TwillRedirectsServiceProvider extends TwillPackageServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/twill_redirects.php' => config_path('twill_redirects.php'),
        ], 'twill-redirects-config');

        parent::boot();
    }
}
