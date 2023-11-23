<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Admix\Http\Middleware\Authenticate;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::prefix(config('admix.path'))
                ->middleware(['web', Authenticate::class . ':admix-web'])
                ->group(__DIR__ . '/../../routes/web.php');

            Route::prefix(config('admix.path') . '/api')
                ->middleware('api')
                ->group(__DIR__ . '/../../routes/api.php');
        });
    }

    public function register(): void
    {
        $this->loadBindings();

        parent::register();
    }

    private function loadBindings(): void
    {
        //
    }
}
