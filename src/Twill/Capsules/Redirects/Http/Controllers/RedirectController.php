<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use TwillRedirects\Enums\RedirectTypes;

class RedirectController extends BaseModuleController
{
    protected $moduleName = 'redirects';

    protected $indexOptions = [
        'permalink' => false,
        'editInModal' => false,
        'skipCreateModal' => false,
        'includeScheduledInList' => true,
    ];

    protected function formData($request)
    {
        $typeOptions = [
            [
                'value' => RedirectTypes::INTERNAL,
                'label' => __('An internal path'),
            ],
            [
                'value' => RedirectTypes::EXTERNAL,
                'label' => __('An external url'),
            ],
        ];

        $browserModules = config('twill_redirects.browser_modules');

        if (! empty($browserModules)) {
            $typeOptions[] = [
                'value' => RedirectTypes::ENTITY,
                'label' => __('An internal entity'),
            ];
        }

        return ['type_options' => $typeOptions, 'browser_modules' => $browserModules];
    }
}
