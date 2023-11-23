<?php

use Agenciafmd\Faqs\Http\Livewire\Pages;

Route::get('/faqs', Pages\Faq\Index::class)
    ->name('admix.faqs.index');
Route::get('/faqs/trash', Pages\Faq\Index::class)
    ->name('admix.faqs.trash');
Route::get('/faqs/create', Pages\Faq\Form::class)
    ->name('admix.faqs.create');
Route::get('/faqs/{faq}/edit', Pages\Faq\Form::class)
    ->name('admix.faqs.edit');
