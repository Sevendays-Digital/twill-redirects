<?php

namespace TwillRedirects\Twill\Capsules\Redirects\Models;

use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use TwillRedirects\Enums\RedirectTypes;
use TwillRedirects\Facades\RedirectManager;

class Redirect extends Model
{
    protected $fillable = [
        'published',
        'title',
        'description',
        'redirect_type',
        'from',
        'to',
        'to_external',
        'redirectable'
    ];

    protected $attributes = [
       'redirect_type' => RedirectTypes::INTERNAL
    ];

    public function redirectable(): MorphTo {
        return $this->morphTo();
    }

    public function getTarget(): string {
        if ($this->redirect_type === RedirectTypes::ENTITY) {
            return RedirectManager::getEntityCallback()($this->redirectable);
        }
        if ($this->redirect_type === RedirectTypes::EXTERNAL) {
            return $this->to_external;
        }
        if ($this->redirect_type === RedirectTypes::INTERNAL) {
            return $this->to;
        }
    }
}
