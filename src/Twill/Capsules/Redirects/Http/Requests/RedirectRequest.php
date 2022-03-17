<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Http\Requests;

use A17\Twill\Http\Requests\Admin\Request;
use TwillRedirects\Enums\RedirectTypes;

class RedirectRequest extends Request
{
    public function rulesForCreate(): array
    {
        return [
        ];
    }

    public function rulesForUpdate(): array
    {
        return [
            'redirect_type' => 'required',
            'from' => 'required',
            'to' => 'required_if:redirect_type,' . RedirectTypes::INTERNAL,
            'to_external' => 'url|required_if:redirect_type,' . RedirectTypes::EXTERNAL
        ];
    }
}
