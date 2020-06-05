<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Faqs\Category;
use Agenciafmd\Faqs\Faq;
use Illuminate\Support\ServiceProvider;

class FaqServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->providers();

        $this->setMenu();

        $this->setSearch();

        $this->loadViews();

        $this->loadMigrations();

        $this->loadTranslations();

        $this->loadViewComposer();

        $this->publish();

        if ($this->app->environment('local') && $this->app->runningInConsole()) {
            $this->setLocalFactories();
        }
    }

    protected function providers()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);
    }

    protected function setMenu()
    {
        $this->app->make('admix-menu')
            ->push((object)[
                'view' => config('admix-faqs.category') ? 'agenciafmd/faqs::partials.menus.category-item' : 'agenciafmd/faqs::partials.menus.item',
                'ord' => config('admix-faqs.sort', 1),
            ]);
    }

    protected function setSearch()
    {
        $this->app->make('admix-search')
            ->registerModel(Faq::class, 'name')
            ->registerModel(Category::class, 'name');
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/faqs');
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function loadTranslations()
    {
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');
    }

    protected function loadViewComposer()
    {
        //
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/faqs'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../config/admix-faqs.php' => config_path('admix-faqs.php'),
            __DIR__ . '/../config/admix-categories.php' => config_path('admix-categories.php'),
            __DIR__ . '/../config/upload-configs.php' => config_path('upload-configs.php'),
        ], 'configs');
    }

    public function setLocalFactories()
    {
        $this->app->make('Illuminate\Database\Eloquent\Factory')
            ->load(__DIR__ . '/../database/factories');
    }

    public function register()
    {
        $this->loadConfigs();
    }

    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admix-faqs.php', 'admix-faqs');
        $this->mergeConfigFrom(__DIR__ . '/../config/admix-categories.php', 'admix-categories');
        $this->mergeConfigFrom(__DIR__ . '/../config/gate.php', 'gate');
        $this->mergeConfigFrom(__DIR__ . '/../config/audit-alias.php', 'audit-alias');
        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
    }
}
