<?php

namespace TwillRedirects\Facades;

use Illuminate\Support\Facades\Facade;

class RedirectManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \TwillRedirects\RedirectManager::class;
    }
}
