<?php

use Agenciafmd\Faqs\Http\Controllers\FaqController;
use Agenciafmd\Categories\Http\Controllers\CategoryController;
use Agenciafmd\Faqs\Models\Faq;
use Agenciafmd\Faqs\Models\Category;

if (config('admix-faqs.category')) {
    Route::get('faqs/categories', [CategoryController::class, 'index'])
        ->name('admix.faqs.categories.index')
        ->middleware('can:view,' . Category::class);
    Route::get('faqs/categories/trash', [CategoryController::class, 'index'])
        ->name('admix.faqs.categories.trash')
        ->middleware('can:restore,' . Category::class);
    Route::get('faqs/categories/create', [CategoryController::class, 'create'])
        ->name('admix.faqs.categories.create')
        ->middleware('can:create,' . Category::class);
    Route::post('faqs/categories', [CategoryController::class, 'store'])
        ->name('admix.faqs.categories.store')
        ->middleware('can:create,' . Category::class);
    Route::get('faqs/categories/{category}', [CategoryController::class, 'show'])
        ->name('admix.faqs.categories.show')
        ->middleware('can:view,' . Category::class);
    Route::get('faqs/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('admix.faqs.categories.edit')
        ->middleware('can:update,' . Category::class);
    Route::put('faqs/categories/{category}', [CategoryController::class, 'update'])
        ->name('admix.faqs.categories.update')
        ->middleware('can:update,' . Category::class);
    Route::delete('faqs/categories/destroy/{category}', [CategoryController::class, 'destroy'])
        ->name('admix.faqs.categories.destroy')
        ->middleware('can:delete,' . Category::class);
    Route::post('faqs/categories/{id}/restore', [CategoryController::class, 'restore'])
        ->name('admix.faqs.categories.restore')
        ->middleware('can:restore,' . Category::class);
    Route::post('faqs/categories/batchDestroy', [CategoryController::class, 'batchDestroy'])
        ->name('admix.faqs.categories.batchDestroy')
        ->middleware('can:delete,' . Category::class);
    Route::post('faqs/categories/batchRestore', [CategoryController::class, 'batchRestore'])
        ->name('admix.faqs.categories.batchRestore')
        ->middleware('can:restore,' . Category::class);
}

Route::get('faqs', [FaqController::class, 'index'])
    ->name('admix.faqs.index')
    ->middleware('can:view,' . Faq::class);
Route::get('faqs/trash', [FaqController::class, 'index'])
    ->name('admix.faqs.trash')
    ->middleware('can:restore,' . Faq::class);
Route::get('faqs/create', [FaqController::class, 'create'])
    ->name('admix.faqs.create')
    ->middleware('can:create,' . Faq::class);
Route::post('faqs', [FaqController::class, 'store'])
    ->name('admix.faqs.store')
    ->middleware('can:create,' . Faq::class);
Route::get('faqs/{faq}/edit', [FaqController::class, 'edit'])
    ->name('admix.faqs.edit')
    ->middleware('can:update,' . Faq::class);
Route::put('faqs/{faq}', [FaqController::class, 'update'])
    ->name('admix.faqs.update')
    ->middleware('can:update,' . Faq::class);
Route::delete('faqs/destroy/{faq}', [FaqController::class, 'destroy'])
    ->name('admix.faqs.destroy')
    ->middleware('can:delete,' . Faq::class);
Route::post('faqs/{id}/restore', [FaqController::class, 'restore'])
    ->name('admix.faqs.restore')
    ->middleware('can:restore,' . Faq::class);
Route::post('faqs/batchDestroy', [FaqController::class, 'batchDestroy'])
    ->name('admix.faqs.batchDestroy')
    ->middleware('can:delete,' . Faq::class);
Route::post('faqs/batchRestore', [FaqController::class, 'batchRestore'])
    ->name('admix.faqs.batchRestore')
    ->middleware('can:restore,' . Faq::class);
