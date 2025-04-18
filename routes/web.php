<?php

use Agenciafmd\Faqs\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/faqs', Pages\Faq\Index::class)
    ->name('admix.faqs.index');
Route::get('/faqs/trash', Pages\Faq\Index::class)
    ->name('admix.faqs.trash');
Route::get('/faqs/create', Pages\Faq\Component::class)
    ->name('admix.faqs.create');
Route::get('/faqs/{faq}/edit', Pages\Faq\Component::class)
    ->name('admix.faqs.edit');
