<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Faqs\Policies\CategoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Agenciafmd\Faqs\Models\Faq;
use Agenciafmd\Faqs\Policies\FaqPolicy;
use Agenciafmd\Faqs\Models\Category;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Faq::class => FaqPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
