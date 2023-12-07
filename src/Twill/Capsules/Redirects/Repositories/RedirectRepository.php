<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Repositories;

use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Repositories\ModuleRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use TwillRedirects\Twill\Capsules\Redirects\Models\Redirect;

class RedirectRepository extends ModuleRepository
{
    public function __construct(Redirect $model)
    {
        $this->model = $model;
    }

    /**
     * @param \A17\Twill\Models\Contracts\TwillModelContract|TwillRedirects\Twill\Capsules\Redirects\Models\Redirect $model
     * @param array                                                                                                  $fields
     *
     * @return void
     */
    public function afterSave(TwillModelContract $model, array $fields): void
    {
        $this->updateBrowser($model, $fields, 'redirectable');

        parent::afterSave($model, $fields);
    }

    public function getFormFields(TwillModelContract $object): array
    {
        $fields = parent::getFormFields($object);

        // Try to figure out the prefix for when it is a nested module.
        $modules = config('twill_redirects.browser_modules');

        if (! empty($modules) && $existing = $object->redirectable) {
            // Find the matching module in the list.
            $routeName = Str::lower(Str::plural(Arr::last(explode('\\', $existing::class))));
            $prefix = null;

            foreach ($modules as $module) {
                if (Str::endsWith($module['name'], '.'.$routeName)) {
                    $prefix = Str::beforeLast($module['name'], '.');
                }
            }

            $fields['browsers']['redirectable'] = $this->getFormFieldsForBrowser($object, 'redirectable', $prefix);
        }

        return $fields;
    }
}
