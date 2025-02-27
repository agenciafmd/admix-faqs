<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Faqs\Livewire\Pages;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.faqs.livewire.pages.faq.index', Pages\Faq\Index::class);
        Livewire::component('agenciafmd.faqs.livewire.pages.faq.component', Pages\Faq\Component::class);
    }

    public function register(): void
    {
        //
    }
}
