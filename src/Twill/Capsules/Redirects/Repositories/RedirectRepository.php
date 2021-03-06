<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Repositories;


use A17\Twill\Repositories\ModuleRepository;
use Arr;
use Illuminate\Support\Str;
use TwillRedirects\Twill\Capsules\Redirects\Models\Redirect;

class RedirectRepository extends ModuleRepository
{
    public function __construct(Redirect $model)
    {
        $this->model = $model;
    }

    /**
     * @param Redirect $object
     */
    public function afterSave($object, $fields)
    {
        $this->updateBrowser($object, $fields, 'redirectable');
        parent::afterSave($object, $fields);
    }

    /**
     * @param Redirect $object
     */
    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);

        // Try to figure out the prefix for when it is a nested module.
        $modules = config('twill_redirects.browser_modules');
        if (!empty($modules) && $existing = $object->redirectable) {
            // Find the matching module in the list.
            $routeName = Str::lower(Str::plural(Arr::last(explode('\\', $existing::class))));

            $prefix = null;
            foreach ($modules as $module) {
                if (Str::endsWith($module['name'], '.' . $routeName)) {
                    $prefix = Str::beforeLast($module['name'], '.');
                }
            }

            $fields['browsers']['redirectable'] = $this->getFormFieldsForBrowser($object, 'redirectable', $prefix);
        }

        return $fields;
    }
}
