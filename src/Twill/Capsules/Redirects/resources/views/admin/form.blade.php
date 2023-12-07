@extends('twill::layouts.form')

@section('contentFields')
    @formField('input', [
        'name' => 'description',
        'label' => __('Description'),
        'note' => __('An optional description of the redirect'),
        'maxlength' => 100
    ])


    @formField('input', [
        'name' => 'from',
        'note' => __('The original path that you want to redirect from'),
        'prefix' => Str::finish(config('app.url'), '/'),
        'label' => __('From')
    ])

    @formField('radios', [
        'name' => 'redirect_type',
        'label' => __('Redirect type'),
        'inline' => true,
        'options' => $type_options,
    ])

    @formField('radios', [
        'name' => 'code',
        'label' => __('Redirect code'),
        'default' => 301,
        'inline' => true,
        'options' => [
            [
                'value' => 301,
                'label' => __('Permanent redirect')
            ],
            [
                'value' => 307,
                'label' => __('Temporary redirect')
            ],
        ]
    ])

    @formConnectedFields([
        'fieldName' => 'redirect_type',
        'fieldValues' => \TwillRedirects\Enums\RedirectTypes::INTERNAL,
        'renderForBlocks' => false,
        'keepAlive' => true,
    ])
        @formField('input', [
            'name' => 'to',
            'note' => __('The target path you want to redirect to'),
            'prefix' => Str::finish(config('app.url'), '/'),
            'label' => __('To')
        ])
    @endformConnectedFields

    @formConnectedFields([
        'fieldName' => 'redirect_type',
        'fieldValues' => \TwillRedirects\Enums\RedirectTypes::EXTERNAL,
        'renderForBlocks' => false,
        'keepAlive' => true,
    ])
        @formField('input', [
            'name' => 'to_external',
            'note' => __('The target url you want to redirect to'),
            'label' => __('To')
        ])
    @endformConnectedFields

    @if(! empty($browser_modules))
        @formConnectedFields([
            'fieldName' => 'redirect_type',
            'fieldValues' => \TwillRedirects\Enums\RedirectTypes::ENTITY,
            'renderForBlocks' => false,
            'keepAlive' => true,
        ])
            @formField('browser', [
                'modules' => $browser_modules,
                'name' => 'redirectable',
                'label' => __('Target entity'),
                'max' => 1,
            ])
        @endformConnectedFields
    @endif
@stop
