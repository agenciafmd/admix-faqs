<?php

namespace Agenciafmd\Faqs\Providers;

use Agenciafmd\Faqs\Http\Livewire\Pages;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.faqs.http.livewire.pages.faq.index', Pages\Faq\Index::class);
        Livewire::component('agenciafmd.faqs.http.livewire.pages.faq.form', Pages\Faq\Form::class);
    }

    public function register(): void
    {
        //
    }
}
