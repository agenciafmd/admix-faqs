<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Faqs\Models\Faq;
use Agenciafmd\Faqs\Policies\FaqPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Faq::class => FaqPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }

    public function register(): void
    {
        $this->registerConfigs();
    }

    public function registerConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/gate.php', 'gate');
    }
}
