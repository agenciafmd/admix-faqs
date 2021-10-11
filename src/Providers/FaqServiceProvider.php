<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Faqs\Models\Category;
use Agenciafmd\Faqs\Models\Faq;
use Illuminate\Support\ServiceProvider;

class FaqServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->providers();

        $this->setSearch();

        $this->loadMigrations();

        $this->publish();
    }

    public function register()
    {
        $this->loadConfigs();
    }

    protected function providers()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    protected function setSearch()
    {
        $this->app->make('admix-search')
            ->registerModel(Faq::class, 'name')
            ->registerModel(Category::class, 'name');
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../config/admix-faqs.php' => config_path('admix-faqs.php'),
            __DIR__ . '/../config/admix-categories.php' => config_path('admix-categories.php'),
            __DIR__ . '/../config/upload-configs.php' => config_path('upload-configs.php'),
        ], 'admix-faqs:configs');

        $factoriesAndSeeders[__DIR__ . '/../Database/Factories/FaqFactory.php'] = base_path('database/factories/FaqFactory.php');
        $factoriesAndSeeders[__DIR__ . '/../Database/Seeders/FaqsTableSeeder.php'] = base_path('database/seeders/FaqsTableSeeder.php');

        if (config('admix-faqs.category')) {
            $factoriesAndSeeders[__DIR__ . '/../Database/Factories/FaqCategoryFactory.php'] = base_path('database/factories/FaqCategoryFactory.php');
            $factoriesAndSeeders[__DIR__ . '/../Database/Seeders/FaqsCategoriesTableSeeder.php'] = base_path('database/seeders/FaqsCategoriesTableSeeder.php');
        }

        $this->publishes($factoriesAndSeeders, 'admix-faqs:seeders');
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
