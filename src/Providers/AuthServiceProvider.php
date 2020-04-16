<?php

namespace Agenciafmd\Faqs\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        '\Agenciafmd\Faqs\Category' => '\Agenciafmd\Faqs\Policies\CategoryPolicy',
        '\Agenciafmd\Faqs\Faq' => '\Agenciafmd\Faqs\Policies\FaqPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
